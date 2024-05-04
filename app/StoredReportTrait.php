<?php

namespace App;

use App\Mail\SendFc007Email;
use App\Models\Fc007Log;
use App\Traits\FpdiTrait;
use App\Traits\QueryTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

trait StoredReportTrait
{
    use QueryTrait;
    use UtilitiesTrait;
    use FpdiTrait;
    use EmailManagementTrait;

    public function generateFC007($fcLogId, $referenceNumber, $output = true, $processId = null, $principalId = null)
    {
        // initiate fpdi
        $pdf = $this->initiateFpdi('NETI-SGA', 'NETI-SGA', $referenceNumber . ".pdf");
        $templatePath = storage_path('app/public/F-FC-007/' . $referenceNumber . '.pdf');
        $pageWidth = 210;
        $pageHeight = 297;

        $totalPages = $pdf->setSourceFile($templatePath);
        $pagesToInclude = range(1, $totalPages);

        foreach ($pagesToInclude as $pageNumber) {
            $pdf->AddPage('P', [$pageWidth, $pageHeight]);
            $importedPage = $pdf->importPage($pageNumber);

            //attach signature method
            $this->attachSignature($pdf, $processId);

            $pdf->useTemplate($importedPage);
        }

        if ($output == true) {
            $pdf->Output();
        } else {
            $newStatusId = $this->getNewStatus($processId);

            if ($processId < 4) { //replace old file becuase of signature attachment => update status => send email
                //---------------------------------------------------------------------------------------//
                //---------------------------------------------------------------------------------------//
                //delete old file
                $deleteFile = Storage::disk('public')->delete('F-FC-007/' . $referenceNumber . '.pdf');

                if (!$deleteFile) {
                    session()->flash('error', 'Sending file saved!');
                }

                // save to folder
                $fileName = $referenceNumber . '.pdf';
                $filePath = storage_path('app/public/F-FC-007/' . $fileName);
                $pdfContents = $pdf->Output('', 'S');
                $storeFile = file_put_contents($filePath, $pdfContents);

                if (!$storeFile) {
                    session()->flash('error', 'Saving file saved!');
                } else {
                    // save to database
                    $this->updateStatus($fcLogId, $processId, $newStatusId);

                    // send email notification
                    $this->sendEmail($newStatusId, $principalId, $processId, $referenceNumber);
                }
                //---------------------------------------------------------------------------------------//
                //---------------------------------------------------------------------------------------//
            } else { //DONT replace old file  => update status => send email
                //---------------------------------------------------------------------------------------//
                //---------------------------------------------------------------------------------------//
                // save to database
                $this->updateStatus($fcLogId, $processId, $newStatusId);

                // send email notification
                $this->sendEmail($newStatusId, $principalId, $processId, $referenceNumber);
                //---------------------------------------------------------------------------------------//
                //---------------------------------------------------------------------------------------//
            }

            return $this->redirectRoute('sga.process-fc007', ['processId' => $processId]);
        }
    }

    public function updateStatus($fcLogId, $processId, $newStatusId)
    {
        $query = Fc007Log::find($fcLogId);
        $update = $this->updateQuery($processId, $query, $newStatusId);
        $this->updateTrait($query, 'sga.process-fc007', $update, "Sending file failed!", "File sent successfully!");
    }

    public function sendEmail($newStatusId, $principalId, $processId, $referenceNumber)
    {
        $emailData = $this->sendEmailNotification($newStatusId, $principalId, $processId);
        $subject = $this->fcEmailSubject($newStatusId);
        foreach ($emailData as $name => $email) {
            Mail::to($email)
                ->cc('sherwin.roxas@neti.com.ph')
                ->send(new SendFc007Email($referenceNumber, $subject, $name));
        }
    }

    public function updateQuery($processId, $query, $newStatusId)
    {
        switch ($processId) {
            case 2:
                $update = $query->update([
                    'status_id' => $newStatusId,
                    'verified_by' => Auth::user()->full_name,
                    'verified_at' => now(),
                ]);
                break;
            case 3:
                $update = $query->update([
                    'status_id' => $newStatusId,
                    'approved_by' => Auth::user()->full_name,
                    'approved_at' => now(),
                ]);
            case 4:
                $update = $query->update([
                    'status_id' => $newStatusId,
                    'payment_slip_by' => Auth::user()->full_name,
                    'payment_slip_at' => now(),
                ]);
                break;
        }
        return $update;
    }

    public function attachSignature($pdf, $processId)
    {
        switch ($processId) {
            case 2:
                $this->getSignature($pdf, Auth::user()->signature_path, 90, 269, 12, 12);
                break;
            case 3:
                $this->getSignature($pdf, Auth::user()->signature_path, 170, 269, 12, 12);
                break;
        }
    }

    public function getNewStatus($processId)
    {
        switch ($processId) {
            case 1:
                $statusId = 2;
                break;
            case 2:
                $statusId = 3;
                break;
            case 3:
                $statusId = 4;
                break;
            case 4:
                $statusId = 5;
                break;
            case 5:
                $statusId = 6;
                break;
        }
        return $statusId;
    }

    public function buttonLabel($statusId)
    {
        switch ($statusId) {
            case 1:
                $label = "Generate";
                break;
            case 2:
                $label = "Verify";
                break;
            case 3:
                $label = "Approve";
                break;
            case 4:
                $label = "Send Payment Slip";
                break;
            default:
                $label = "Upload O.R.";
                break;
        }
        return $label;
    }
}
