<?php

namespace App;

use App\Models\Fc007ReportEmailRecipient;

trait EmailManagementTrait
{
    public function pageTitle($value)
    {
        switch ($value) {
            case '1':
                $title = "Generate Board";
                break;
            case '2':
                $title = "Verification Board";
                break;
            case '3':
                $title = "Approval Board";
                break;
            case '4':
                $title = "Principal Board";
                break;
            default:
                $title = "";
                break;
        }

        return $title;
    }

    public function fcEmailSubject($value)
    {
        switch ($value) {
            case '1':
                $subject = "Generate Process";
                break;
            case '2':
                $subject = "Verification Process";
                break;
            case '3':
                $subject = "Approval Process";
                break;
            case '4':
                $subject = "Principal Process";
                break;
            default:
                $subject = "";
                break;
        }

        return $subject;
    }

    public function sendEmailNotification($processId)
    {
        $emailData = Fc007ReportEmailRecipient::where('process_id', $processId)
            ->where('is_active', 1)
            ->with('user:id,email,f_name')
            ->get()
            ->pluck('user.email','user.f_name');
            
        return $emailData;
    }
}
