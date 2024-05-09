<?php

namespace App;

use App\Mail\SendSummaryEmail;
use Carbon\Carbon;
use App\Models\User;
use NumberFormatter;
use App\Models\Vessel;
use App\Models\Company;
use App\Models\Principal;
use App\Models\Recipient;
use App\Traits\FpdiTrait;
use App\Models\SummaryLog;
use App\Traits\QueryTrait;
use App\Models\Vessel_type;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

trait SummaryTrait
{
    use FpdiTrait;
    use QueryTrait;
    use UtilitiesTrait;
    use EmailManagementTrait;

    public function generateSummary(
        $monthSession,
        $principalIdSession,
        $recipientIdSession,
        $output = true,
        $referenceNumber = null,
        $currentProcessId = 1,
        $generatedByUserId = null,
        $verifiedByUserId = null,
        $approvedByUserId = null
    ) {
        // data
        // session
        $month = $monthSession;
        $principalId = $principalIdSession;
        $principalData = Company::find($principalId);
        $recipientId = $recipientIdSession;
        $recipientData = User::find($recipientId);
        $comptrollerData = User::where('position_id', 2)->where('is_active', 1)->first();
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
        // data end

        //initiate pdf, imported from FpdiTrait
        $pdf = $this->initiateFpdi('NETI-SGA', 'NETI-SGA', 'Training Fee Summary and Letter');

        // LETTER PAGE
        // LETTER PAGE

        // template
        $templatePath = storage_path('app/public/SGA/SGA-Letter.pdf');
        $template = $pdf->setSourceFile($templatePath);
        $importedPage = $pdf->importPage($template);
        $pageWidth = 210;
        $pageHeight = 297;

        $this->letterPage(
            $pdf,
            $importedPage,
            $currentDate,
            $principalData,
            $recipientData,
            $formattedStringTotalTrainingFee,
            $formattedTotalTrainingFee,
            $vesselTypeData,
            $formattedTrainingFee,
            $formattedBankCharge,
            $formattedMonth,
            $pageWidth,
            $pageHeight,
            $comptrollerData,
            $currentProcessId
        );
        // LETTER PAGE END
        // LETTER PAGE END

        // TRAINEE FEE PAGE
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
                $currentDate,
                $pageWidth,
                $pageHeight
            );

            // vessel data
            $totalFee = 0;
            foreach ($vesselData as $index => $vessel) {
                $totalFee += $vessel->training_fee;
                $pdf->setX(21);
                $pdf->Cell(7, 5, $index + 1, 1, 0, "C");
                $pdf->Cell(50, 5, $vessel->name, 1, 0, "L");
                $pdf->Cell(18, 5, $vessel->code, 1, 0, "C");
                $pdf->Cell(32, 5, $vessel->formatted_serial_number, 1, 0, "C");
                $pdf->Cell(32, 5, ($index + 1 == 1 ? "$  " : "") . number_format($vessel->training_fee, 2), 1, 0, "R");
                $pdf->Cell(32, 5, $vessel->remarks, 1, 1, "C");

                if ($index == 34) {
                    $this->traineeFeeSignature($pdf, $totalFee, $currentProcessId, $generatedByUserId, $verifiedByUserId, $approvedByUserId);
                    $this->trainingFeePage2(
                        $pdf,
                        $totalFee,
                        $pageWidth,
                        $pageHeight
                    );
                    $totalFee = 0;
                }
            }
            $this->traineeFeeSignature($pdf, $totalFee, $currentProcessId, $generatedByUserId, $verifiedByUserId, $approvedByUserId);
        }
        // TRAINEE FEE PAGE END

        if ($output) {
            $pdf->Output();
        } else {
            $errorMsg = "Saving summary report failed!";
            $successMsg = "Summary report saved successfully!";

            if ($currentProcessId < 4 && $currentProcessId > 1) { //delete old file
                //delete old file
                Storage::disk('public')->delete('Summary/' . $referenceNumber . '.pdf');
            }

            if ($currentProcessId > 3) {
                $query = $this->summaryQuery($currentProcessId, $referenceNumber, NULL, $principalId, $month);
                // save to database
                $this->storeLogs($query, $errorMsg, $successMsg);
            } else {
                // save to folder
                $fileName = $referenceNumber . '.pdf';
                $filePath = storage_path('app/public/Summary/' . $fileName);
                $pdfContents = $pdf->Output('', 'S');
                $storeFile = file_put_contents($filePath, $pdfContents);

                if (!$storeFile) {
                    session()->flash('error', ' Saving file failed!');
                } else {

                    $query = $this->summaryQuery($currentProcessId, $referenceNumber, $fileName, $principalId, $month);
                    // save to database
                    $this->storeLogs($query, $errorMsg, $successMsg);
                }
            }

            // send email notification
            $emailRecipient = $this->getSummaryReportRecipient($currentProcessId, $principalId);
            $emailSubject = $this->SummaryEmailSubject($currentProcessId);
            foreach ($emailRecipient as $name => $email) {
                Mail::to($email)
                    ->cc('sherwin.roxas@neti.com.ph')
                    ->send(new SendSummaryEmail($referenceNumber, $emailSubject, $name));
            }


            return $this->redirectRoute('dashboard.summary');
        }
    }

    public function letterPage(
        $pdf,
        $importedPage,
        $currentDate,
        $principalData,
        $recipientData,
        $formattedStringTotalTrainingFee,
        $formattedTotalTrainingFee,
        $vesselTypeData,
        $formattedTrainingFee,
        $formattedBankCharge,
        $formattedMonth,
        $pageWidth,
        $pageHeight,
        $comptrollerData,
        $currentProcessId
    ) {
        $pdf->AddPage('P', [$pageWidth, $pageHeight]);

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
        $pdf->Cell(80, 0, $recipientData->summary_recipient_name, 0, 0, "L");
        $pdf->setXY(60, 60);
        $pdf->Cell(80, 0, $recipientData->position->name, 0, 0, "L");
        $pdf->setXY(60, 64);
        $pdf->Cell(80, 0, $recipientData->department->name, 0, 0, "L");

        // content
        $htmlContent = "Dear Sir:

                    We are please to enclose herewith our Statement of General Accounts (SGA) in the total amount of US Dollars: " . Str::upper($formattedStringTotalTrainingFee) . " (USD " . $formattedTotalTrainingFee . ") which covers Training Fees for the following types of vessel for the month of " . $formattedMonth . ".";
        // Encode the address as HTML with preserved line breaks
        $contentHtml = nl2br(htmlspecialchars($htmlContent));
        $pdf->writeHTMLCell(165, 0, 24, 71, $contentHtml, 0, 0, false, true, 'J');

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
        $pdf->Cell(25, 0, Str::upper($comptrollerData->full_name), 0, 0, "L");
        $pdf->setXY(24, 226);
        $pdf->Cell(25, 0, $comptrollerData->position->name, 0, 0, "L");

        // Display the PNG image
        if ($currentProcessId > 2) {
            $this->getSignature($pdf, $comptrollerData->signature_path, 35, 203, 44, 22);
        }
    }

    public function trainingFeePage(
        $pdf,
        $importedTrainingFeePage,
        $formattedMonth,
        $vesselTypeName,
        $principalName,
        $currentDate,
        $pageWidth,
        $pageHeight
    ) {
        $pdf->AddPage('P', [$pageWidth, $pageHeight]);
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
        $pdf->setXY(48, 46.1);
        $pdf->Cell(30, 0, $principalName, 0, 0, "L");
        $pdf->setXY(48, 49.5);
        $pdf->Cell(30, 0, $currentDate, 0, 0, "L");

        // Set font
        $pdf->SetFont('Helvetica', 'B', 8);
        //table header
        $pdf->setXY(21, 58);
        $pdf->Cell(7, 5, "No.", 1, 0, "C");
        $pdf->Cell(50, 5, "Name of Vessel", 1, 0, "C");
        $pdf->Cell(18, 5, "Vessel Code", 1, 0, "C");
        $pdf->Cell(32, 5, "SGA Serial Number", 1, 0, "C");
        $pdf->Cell(32, 5, "Amount", 1, 0, "C");
        $pdf->Cell(32, 5, "Remarks", 1, 1, "C");
    }

    public function trainingFeePage2(
        $pdf,
        $forwardedBalance,
        $pageWidth,
        $pageHeight
    ) {
        $pdf->AddPage('P', [$pageWidth, $pageHeight]);
        $pdf->setXY(21, 25);
        $pdf->Cell(7, 5, '', 1, 0, "C");
        $pdf->Cell(50, 5, 'BALANCE FORWARDED', 1, 0, "L");
        $pdf->Cell(18, 5, '', 1, 0, "C");
        $pdf->Cell(32, 5, '', 1, 0, "C");
        $pdf->Cell(32, 5, "$  " . number_format($forwardedBalance, 2), 1, 0, "R");
        $pdf->Cell(32, 5, "", 1, 1, "C");
    }

    public function traineeFeeSignature($pdf, $totalFee, $currentProcessId, $generatedByUserId = null, $verifiedByUserId = null, $approvedByUserId = null)
    {
        $pdf->setX(21);
        $pdf->Cell(7, 5,  "", 1, 0, "C");
        $pdf->Cell(50, 5, "TOTAL", 1, 0, "L");
        $pdf->Cell(18, 5, "", 1, 0, "C");
        $pdf->Cell(32, 5, "", 1, 0, "C");
        $pdf->Cell(32, 5, "$  " . number_format($totalFee, 2), 1, 0, "R");
        $pdf->Cell(32, 5, "", 1, 1, "C");

        //signature heading
        $pdf->setX(21);
        $pdf->Cell(57, 5,  'Prepared by: ', 'LTR', 0, "L");
        $pdf->Cell(18, 5,  '', 'LTR', 0, "L");
        $pdf->Cell(32, 5,  '', 'LTR', 0, "L");
        $pdf->Cell(32, 5,  'Noted by: ', 'LTR', 0, "L");
        $pdf->Cell(32, 5,  'Approved by: ', 'LTR', 1, "L");
        //signatures

        $pdf->setX(21);
        // generated by
        if ($generatedByUserId != null) {
            $pdf->Cell(57, 8,  $this->getSignature($pdf, $this->getSignaturePath(
                User::find($generatedByUserId)
            ), null, null, 25, 20), 'LR', 0, "C");
        } else {
            $pdf->Cell(57, 8,  $this->getSignature($pdf, Auth::user()->signature_path, null, null, 25, 20), 'LR', 0, "C");
        }
        // generated end

        $pdf->Cell(18, 8,  '', 'LR', 0, "L");
        $pdf->Cell(32, 8,  '', 'LR', 0, "L");

        // verified
        if ($currentProcessId > 2) {
            $pdf->Cell(32, 8,  $this->getSignature($pdf, $this->getSignature($pdf, $this->getSignaturePath(
                User::find($verifiedByUserId)
            ), null, null, 25, 20), null, null, 25, 20), 'LR', 0, "L");
        } else if ($currentProcessId == 2) {
            $pdf->Cell(32, 8,  $this->getSignature($pdf, Auth::user()->signature_path, null, null, 25, 20), 'LR', 0, "L");
        } else {
            $pdf->Cell(32, 8,  '', 'LR', 0, "L");
        }
        // verified end

        //approved
        if ($currentProcessId > 3) {
            $pdf->Cell(32, 8,  $this->getSignature($pdf, $this->getSignature($pdf, $this->getSignaturePath(
                User::find($approvedByUserId)
            ), null, null, 25, 20), null, null, 25, 20), 'LR', 1, "L");
        } else if ($currentProcessId == 3) {
            $pdf->Cell(32, 8,  $this->getSignature($pdf, Auth::user()->signature_path, null, null, 25, 20), 'LR', 1, "L");
        } else {
            $pdf->Cell(32, 8,  '', 'LR', 1, "L");
        }
        //approved end

        //signature names
        $pdf->setX(21);
        $pdf->Cell(57, 5,  'J.V.DABUCOL', 'LBR', 0, "L");
        $pdf->Cell(18, 5,  '', 'LBR', 0, "L");
        $pdf->Cell(32, 5,  '', 'LBR', 0, "L");
        $pdf->Cell(32, 5,  'B.R.MACALINO', 'LBR', 0, "L");
        $pdf->Cell(32, 5,  'M.A.MONIS', 'LBR', 0, "L");
    }

    public function getSignaturePath($query = null)
    {
        if ($query != null) {
            $signaturePath = $query->signature_path;
            return $signaturePath;
        } else {
            return Auth::user()->signature_path;
        }
    }

    public function storeLogs($query, $errorMsg, $successMsg)
    {
        $this->storeTrait($query, $errorMsg, $successMsg);
    }

    public function summaryQuery($currentProcessId, $referenceNumber, $filePath = null, $principalId, $monthSession = null)
    {
        switch ($currentProcessId) {
            case 1:
                $query = SummaryLog::create([
                    'reference_number' => $referenceNumber,
                    'file_path' => $filePath,
                    'status_id' => 2,
                    'generated_by' => Auth::user()->full_name,
                    'principal_id' => $principalId,
                    'month' => $monthSession,
                    'generated_user_id' => Auth::user()->id,
                ]);
                break;
            case 2:
                $query = SummaryLog::where('reference_number', $referenceNumber)->first()->update([
                    'file_path' => $filePath,
                    'status_id' => 3,
                    'verified_by' => Auth::user()->full_name,
                    'verified_user_id' => Auth::user()->id,
                    'verified_at' => now(),
                ]);
                break;
            case 3:
                $query = SummaryLog::where('reference_number', $referenceNumber)->first()->update([
                    'file_path' => $filePath,
                    'status_id' => 4,
                    'approved_by' => Auth::user()->full_name,
                    'approved_user_id' => Auth::user()->id,
                    'approved_at' => now(),
                ]);
                break;
            case 4:
                $query = SummaryLog::where('reference_number', $referenceNumber)->first()->update([
                    'status_id' => 5,
                    'received_by' => Auth::user()->full_name,
                    'received_user_id' => Auth::user()->id,
                    'received_at' => now(),
                ]);
                break;
            default:
                $query = "";
                break;
        }

        return $query;
    }

    public function buttonLabel($currentStatus)
    {
        switch ($currentStatus) {
            case 1:
                $buttonLabel = "Send for verification";
                break;
            case 2:
                $buttonLabel = "Send for Approval";
                break;
            case 3:
                $buttonLabel = "Approve";
                break;
            default:
                $buttonLabel = "Confirm";
                break;
        }
        return $buttonLabel;
    }
}
