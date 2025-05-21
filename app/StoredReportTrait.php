<?php

namespace App;

use App\Mail\SendFc007Email;
use App\Models\Fc007Log;
use App\Traits\FpdiTrait;
use App\Traits\QueryTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

trait StoredReportTrait
{
    use AuthorizesRequests;
    use QueryTrait;
    use UtilitiesTrait;
    use FpdiTrait;
    use EmailManagementTrait;
    use SummaryTrait;

    public function authorization($processId)
    {
        switch ($processId) {
            case 1:
                Gate::authorize('Authorize', 41);
                break;
            case 2:
                Gate::authorize('Authorize', 42);
                break;
            case 3:
                Gate::authorize('Authorize', 43);
                break;
            case 4:
                Gate::authorize('Authorize', 44);
                break;
            // case 5:
            //     Gate::authorize('Authorize', 45);
            //     break;
            default:
                Gate::authorize('Authorize', 45);
                break;
        }
    }

    //training fee methods
    //training fee methods
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

            if ($processId < 3) { //replace old file becuase of signature attachment => update status => send email
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
                    // $this->sendEmail($newStatusId, $principalId, $processId, $referenceNumber);
                }
                //---------------------------------------------------------------------------------------//
                //---------------------------------------------------------------------------------------//
            } else { //DONT replace old file  => update status => send email
                //---------------------------------------------------------------------------------------//
                //---------------------------------------------------------------------------------------//
                // save to database
                $this->updateStatus($fcLogId, $processId, $newStatusId);

                // send email notification
                // $this->sendEmail($newStatusId, $principalId, $processId, $referenceNumber);
                //---------------------------------------------------------------------------------------//
                //---------------------------------------------------------------------------------------//
            }

            return $this->redirectRoute('dashboard.fc007', ['processId' => $processId]);
        }
    }

    public function updateStatus($fcLogId, $processId, $newStatusId)
    {
        $query = Fc007Log::find($fcLogId);
        $update = $this->updateQuery($processId, $query, $newStatusId);
        $successMessage = $this->successMessage($newStatusId);
        $this->updateTrait($query, 'sga.process-fc007', $update, "Sending report failed!", $successMessage);
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
                    'verified_by' => Auth::user()->full_name ?? ' ',
                    'verified_at' => now(),
                ]);
                break;
            case 3:
                $update = $query->update([
                    'status_id' => $newStatusId,
                    'approved_by' => Auth::user()->full_name ?? ' ',
                    'approved_at' => now(),
                ]);
            case 4:
                $update = $query->update([
                    'status_id' => $newStatusId,
                    'payment_slip_by' => Auth::user()->full_name ?? ' ',
                    'payment_slip_at' => now(),
                ]);
            case 5:
                $update = $query->update([
                    'status_id' => $newStatusId,
                    'or_by' => Auth::user()->full_name ?? ' ',
                    'or_at' => now(),
                ]);
                break;
        }
        return $update;
    }

    public function attachSignature($pdf, $processId)
    {
        // Verified By
        $pdf->SetFont('Helvetica', 'B', 9);
        $pdf->setXY(168, 272.5);
        $pdf->Cell(20.5, 5, "B.A. Nadayao", 0, 0, "L");
        // $this->getSignature($pdf, Auth::user()->signature_path, 175, 269, 12, 12);
        $this->getSignature($pdf, 'Miss Deth Sig.png', 168, 265, 23, 23);
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
            default:
                $label = "Approve";
                break;
        }
        return $label;
    }

    public function successMessage($newStatusId)
    {
        switch ($newStatusId) {
            case 2:
                $successMessage = "Report successfully sent for verification!";
                break;
            case 3:
                $successMessage = "Report successfully sent for approval!";
                break;
            case 4:
                $successMessage = "Report successfully sent for approval!";
                break;
            default:
                $successMessage = "Report approved by president!";
                break;
        }
        return $successMessage;
    }

    public function attachmentTypeId($processId)
    {
        switch ($processId) {
            case 4:
                $attachmentTypeId = 1;
                break;
            default:
                $attachmentTypeId = 2;
                break;
        }
        return $attachmentTypeId;
    }
    //training fee methods end
    //training fee methods end
}
