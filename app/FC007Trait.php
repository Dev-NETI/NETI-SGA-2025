<?php

namespace App;

use App\Models\Fc007Log;
use Carbon\Carbon;
use App\Models\Vessel;
use App\Traits\FpdiTrait;
use App\Traits\QueryTrait;
use App\Models\Vessel_type;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

trait FC007Trait
{
    use FpdiTrait;
    use QueryTrait;

    public function generateFC007($sessionPrincipalId, $sessionMonth, $sessionVesselTypeId, $output = true, $referenceNumber = null)
    {
        // data
        $principalId = $sessionPrincipalId;
        $month = $sessionMonth;
        $vesselTypeId = $sessionVesselTypeId;
        $vesselTypeData = Vessel_type::find($vesselTypeId);
        $vesselData = Vessel::where('principal_id', $principalId)
            ->where('vessel_type_id', $vesselTypeId)
            ->where('is_active', true)
            ->orderBy('name', 'asc')
            ->get();
        $formattedMonth = Carbon::createFromFormat("Y-m", $month)->format('F Y');
        $subtractMonth = Carbon::createFromFormat("Y-m", $month)->subMonth()->format('F Y');
        $currentDate = Carbon::now()->format('Y F d');
        // data end

        // initiate fpdi
        $pdf = $this->initiateFpdi('NETI-SGA', 'NETI-SGA', $vesselTypeData->name . " - " . $formattedMonth . " TRAINING FEE.pdf");
        $templatePath = storage_path('app/public/SGA/Training Fee Template.pdf');
        $template = $pdf->setSourceFile($templatePath);
        $importedPage = $pdf->importPage($template);
        $pageWidth = 210;
        $pageHeight = 297;

        foreach ($vesselData as $data) {
            $this->trainingFee($pdf, $importedPage, $data, $currentDate, $formattedMonth, $subtractMonth, $pageWidth, $pageHeight);
        }

        if ($output) {
            $pdf->Output();
        } else {
            // save to folder
            $fileName = $referenceNumber . '.pdf';
            $filePath = storage_path('app/public/F-FC-007/' . $fileName);
            $pdfContents = $pdf->Output('', 'S');
            $storeFile = file_put_contents($filePath, $pdfContents);

            if (!$storeFile) {
                session()->flash('error', 'Saving file failed!');
            } else {
                // Get the file size
                $fileSize = filesize($filePath);

                $errorMsg = "Saving summary report failed!";
                $successMsg = "Summary report saved successfully!";
                // save to database
                $this->storeLogs($referenceNumber, $fileName, $fileSize, $errorMsg, $successMsg);
                // update serial number
                foreach ($vesselData as $data) {
                    $this->updateSerialNumber($data->id, $data->incremented_serial_number, $errorMsg, $successMsg);
                }
                // download pdf
                return $this->redirect(asset('storage/F-FC-007/' . $fileName));
                // return $this->redirectRoute('sga.tFee-index');
            }
        }
    }

    public function updateSerialNumber($id, $newSerialNumber, $errorMsg, $successMsg)
    {
        $vessel = Vessel::find($id);
        $update = $vessel->update([
            'serial_number' => $newSerialNumber,
        ]);

        $this->updateTraitNoRoute($vessel, $update, $errorMsg, $successMsg);
    }

    public function trainingFee($pdf, $importedPage, $data, $currentDate, $formattedMonth, $subtractMonth, $pageWidth, $pageHeight)
    {
        $pdf->AddPage('P', [$pageWidth, $pageHeight]);
        $pdf->useTemplate($importedPage);
        // Set font
        $pdf->SetFont('Helvetica', 'B', 9);

        // serial number
        $pdf->setXY(174, 19);
        $pdf->Cell(20.5, 5, $data->training_fee_serial_number, 0, 0, "C");
        // name of vessel
        $pdf->setXY(92, 54.8);
        $pdf->Cell(25, 5, $data->formatted_name_with_code, 0, 0, "C");
        // current date
        $pdf->setXY(165, 54.8);
        $pdf->Cell(25, 5, $currentDate, 0, 0, "C");
        // for the period
        $pdf->setXY(92, 62);
        $pdf->Cell(20.5, 5, $formattedMonth, 0, 0, "C");

        // particulars
        $pdf->SetFont('Helvetica', '', 9);
        $pdf->setXY(40.5, 74);
        $pdf->Cell(20.5, 5, "Training Fee - for the month of " . $formattedMonth, 0, 0, "L");
        $pdf->setXY(40.5, 86);
        $pdf->Cell(20.5, 5, "Add: " . $subtractMonth . " per SGA " . $data->subtracted_serialNumber, 0, 0, "L");
        $pdf->setXY(40.5, 99);
        $pdf->Cell(20.5, 5, "Less: Remittance received for " . $subtractMonth . " SGA Fee", 0, 0, "L");

        // price
        $trainingFee = $data->training_fee;
        $addedFee = $trainingFee * 2;
        $lessedFee = $addedFee - $trainingFee;
        $pdf->SetFont('Helvetica', 'B', 9);
        $pdf->setXY(180, 74);
        $pdf->Cell(20.5, 5, number_format($trainingFee, 2), 0, 0, "L");

        $pdf->setXY(180, 79);
        $pdf->Cell(20.5, 5, number_format($trainingFee, 2), 0, 0, "L");

        $pdf->SetFont('Helvetica', '', 9);
        $pdf->setXY(180, 86);
        $pdf->Cell(20.5, 5, number_format($trainingFee, 2), 0, 0, "L");

        $pdf->SetFont('Helvetica', 'B', 9);
        $pdf->setXY(180, 92.3);
        $pdf->Cell(20.5, 5, number_format($addedFee, 2), 0, 0, "L");

        $pdf->SetFont('Helvetica', '', 9);
        $pdf->setXY(180, 99);
        $pdf->Cell(20.5, 5, number_format($trainingFee, 2), 0, 0, "L");

        $pdf->SetFont('Helvetica', 'B', 9);
        $pdf->setXY(180, 105);
        $pdf->Cell(20.5, 5, number_format($lessedFee, 2), 0, 0, "L");
    }

    public function storeLogs($referenceNumber, $filePath, $errorMsg, $successMsg)
    {
        $query = Fc007Log::create([
            'reference_number' => $referenceNumber,
            'file_path' => $filePath,
        ]);

        $this->storeTrait($query, $errorMsg, $successMsg);
    }
}
