<?php

namespace App\Livewire\Reports\SGA;

use TCPDF_FONTS;
use Carbon\Carbon;
use NumberFormatter;
use App\Models\Vessel;
use Livewire\Component;
use App\Models\Principal;
use App\Models\Recipient;
use App\Models\User;
use App\Models\Vessel_type;
use Illuminate\Support\Str;
use setasign\Fpdi\Tcpdf\Fpdi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use TCPDF;

class LetterComponent extends Component
{
    public function render()
    {
        return view('livewire.reports.s-g-a.letter-component');
    }

    public function generate()
    {
        // session
        $month = Session::get('month');
        $principalId = Session::get('principalId');
        $principalData = Principal::find($principalId);
        $recipientId = Session::get('recipientId');
        $recipientData = Recipient::find($recipientId);
        $userId = Session::get('userlId');
        $userData = User::find($userId);
        $currentDate = Carbon::now()->format('Y F d');
        //vessel type data
        $vesselTypeData = Vessel_type::whereHas('vessel', function ($query) use ($principalId) {
            $query->where('principal_id', $principalId)
                ->where('is_active', true);
        })
            ->orderBy('id', 'asc')->get();
        // training fee
        $bankCharge = 10;
        $trainingFee = Vessel::where('principal_id', $principalId)->where('is_active', true)->sum('training_fee');
        $totalTrainingFee = $trainingFee + $bankCharge;
        // formatted training fee
        $formattedBankCharge = number_format($bankCharge, 2);
        $formattedTrainingFee = number_format($trainingFee, 2);
        $formattedTotalTrainingFee = number_format($totalTrainingFee, 2);
        $formatter = new NumberFormatter('en', NumberFormatter::SPELLOUT);
        $formattedStringTotalTrainingFee = $formatter->format($totalTrainingFee);
        // month in word
        $formattedMonth = Carbon::createFromFormat("Y-m", $month)->format('F Y');

        $pdf = new Fpdi();
        $pdf->SetMargins(PDF_MARGIN_LEFT, 40, PDF_MARGIN_RIGHT);
        $pdf->SetAutoPageBreak(false, 40);
        $pdf->SetCreator('NETI-SGA');
        $pdf->SetAuthor('NETI-SGA');
        $pdf->SetTitle('Training Fee Summary and Letter');

        // template
        $templatePath = storage_path('app/public/SGA/SGA-Letter.pdf');
        $template = $pdf->setSourceFile($templatePath);
        $importedPage = $pdf->importPage($template);

        // LETTER PAGE
        // LETTER PAGE
        $pdf->AddPage('P');

        $pdf->useTemplate($importedPage);
        // Set font
        $pdf->SetFont('Helvetica', 'B', 9);

        // current date
        $pdf->setXY(24, 28);
        $pdf->Cell(30, 0, $currentDate, 0, 0, "L");

        // Principal
        $pdf->setXY(24, 35);
        $pdf->Cell(80, 0, $principalData->name, 0, 0, "L");
        // Encode the address as HTML with preserved line breaks
        $addressHtml = nl2br(htmlspecialchars($principalData->address));
        $pdf->writeHTMLCell(80, 0, 24, 39, $addressHtml, 0, 0, false, true, 'L');

        // recipient
        $pdf->setXY(60, 56);
        $pdf->Cell(80, 0, $recipientData->name, 0, 0, "L");
        $pdf->setXY(60, 60);
        $pdf->Cell(80, 0, $recipientData->position, 0, 0, "L");
        $pdf->setXY(60, 64);
        $pdf->Cell(80, 0, $recipientData->department, 0, 0, "L");

        // content
        $htmlContent = "Dear Sir:

                    We are please to enclose herewith our Statement of General Accounts (SGA) in the total amount of US Dollars: " . Str::upper($formattedStringTotalTrainingFee) . " (USD " . $formattedTotalTrainingFee . ") which covers Training Fees for the following types of vessel for the month of " . $formattedMonth . ".";
        // Encode the address as HTML with preserved line breaks
        $conentHtml = nl2br(htmlspecialchars($htmlContent));
        $pdf->writeHTMLCell(165, 0, 24, 71, $conentHtml, 0, 0, false, true, 'J');

        //vessel type data and price
        $pdf->setXY(40, 106.7);
        foreach ($vesselTypeData as $vesselType) {
            // dump($vesselType->vessel);
            // dump($vesselType->vessel->sum('training_fee'));
            $pdf->setX(40);
            $pdf->Cell(38, 0, $vesselType->name, 0, 0, "L");
            $pdf->Cell(30, 0, number_format($vesselType->vessel->sum('training_fee'), 2), 0, 1, "R");
        }

        // total
        $pdf->setXY(85, 150.5);
        $pdf->Cell(25, 0, $formattedTrainingFee, 0, 0, "R");
        $pdf->setXY(85, 154.5);
        $pdf->Cell(25, 0, $formattedBankCharge, 0, 0, "R");
        $pdf->setXY(85, 158.5);
        $pdf->Cell(25, 0, $formattedTotalTrainingFee, 0, 0, "R");

        // signature
        $pdf->setXY(24, 222);
        $pdf->Cell(25, 0, Str::upper($userData->full_name), 0, 0, "L");
        $pdf->setXY(24, 226);
        $pdf->Cell(25, 0, $userData->position->name, 0, 0, "L");

        // Display the PNG image
        $imagePath = storage_path('app/public/signature/' . $userData->signature_path);
        $pdf->Image($imagePath, 35, 203, 44, 22, 'PNG', '', '', false, 300, '', false, false, 0, false, false);

        // LETTER PAGE END
        // LETTER PAGE END

        //--------------------------------------------------------------------------------------------------------------------//
        //--------------------------------------------------------------------------------------------------------------------//
        //--------------------------------------------------------------------------------------------------------------------//

        // training template
        $trainingFeeTemplatePath = storage_path('app/public/SGA/SGA-Training-Fee.pdf');
        $trainingFeeTemplate = $pdf->setSourceFile($trainingFeeTemplatePath);
        $importedTrainingFeePage = $pdf->importPage($trainingFeeTemplate);

        foreach ($vesselTypeData as $vesselType) {

            $vesselData = $vesselType->vessel;
            $this->trainingFeePage(
                $pdf,
                $importedTrainingFeePage,
                $formattedMonth,
                $vesselType->name,
                $principalData->name,
                $currentDate
            );

            // vessel data
            $totalFee = 0;
            foreach ($vesselData as $index => $vessel) {
                $totalFee += $vessel->training_fee;
                $pdf->setX(36);
                $pdf->Cell(7, 5, $index + 1, 1, 0, "C");
                $pdf->Cell(41, 5, $vessel->name, 1, 0, "L");
                $pdf->Cell(18, 5, $vessel->code, 1, 0, "C");
                $pdf->Cell(28, 5, $vessel->serial_number, 1, 0, "C");
                $pdf->Cell(23, 5, ($index + 1 == 1 ? "$  " : "") . number_format($vessel->training_fee, 2), 1, 0, "R");
                $pdf->Cell(25, 5, $vessel->remarks, 1, 1, "C");

                if ($index == 34) {
                    $this->traineeFeeSignature($pdf, $totalFee);
                    $totalFee = 0;
                    $this->trainingFeePage(
                        $pdf,
                        $importedTrainingFeePage,
                        $formattedMonth,
                        $vesselType->name,
                        $principalData->name,
                        $currentDate
                    );
                }
            }
            $this->traineeFeeSignature($pdf, $totalFee);
        }

        $pdf->Output();
    }

    public function trainingFeePage(
        $pdf,
        $importedTrainingFeePage,
        $formattedMonth,
        $vesselTypeName,
        $principalName,
        $currentDate
    ) {
        $pdf->AddPage('P');
        $pdf->useTemplate($importedTrainingFeePage);
        // Set font
        $pdf->SetFont('Helvetica', 'B', 7);

        // month
        $pdf->setXY(90, 30.6);
        $pdf->Cell(30, 0, $formattedMonth, 0, 0, "C");

        // Vessel
        $pdf->setXY(90, 36.8);
        $pdf->Cell(30, 0, $vesselTypeName, 0, 0, "C");

        // submitted to
        $pdf->setXY(68, 46.1);
        $pdf->Cell(30, 0, $principalName, 0, 0, "L");
        $pdf->setXY(68, 49.1);
        $pdf->Cell(30, 0, $currentDate, 0, 0, "L");

        // Set font
        $pdf->SetFont('Helvetica', 'B', 8);
        //table header
        $pdf->setXY(36, 58);
        $pdf->Cell(7, 5, "No.", 1, 0, "C");
        $pdf->Cell(41, 5, "Name of Vessel", 1, 0, "C");
        $pdf->Cell(18, 5, "Vessel Code", 1, 0, "C");
        $pdf->Cell(28, 5, "SGA Serial Number", 1, 0, "C");
        $pdf->Cell(23, 5, "Amount", 1, 0, "C");
        $pdf->Cell(25, 5, "Remarks", 1, 1, "C");
    }

    public function traineeFeeSignature($pdf,$totalFee)
    {
        $pdf->setX(36);
        $pdf->Cell(7, 5,  "", 1, 0, "C");
        $pdf->Cell(41, 5, "TOTAL", 1, 0, "L");
        $pdf->Cell(18, 5, "", 1, 0, "C");
        $pdf->Cell(28, 5, "", 1, 0, "C");
        $pdf->Cell(23, 5, "$  ".number_format($totalFee, 2), 1, 0, "R");
        $pdf->Cell(25, 5, "", 1, 1, "C");
        //
        $pdf->setX(36);
        $pdf->MultiCell(48, 15, 'Prepared by:', 1, 'L', false, 0);
        $pdf->MultiCell(18, 15, '', 1, 'L', false, 0);
        $pdf->MultiCell(28, 15, '', 1, 'L', false, 0);
        $pdf->MultiCell(23, 15, 'Noted by:', 1, 'L', false, 0);
        $pdf->MultiCell(25, 15, 'Approved by:', 1, 'L', false, 0);
    }
}
