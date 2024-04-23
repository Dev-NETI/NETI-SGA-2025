<?php

namespace App;

trait EmailManagementTrait
{
    public function pageTitle($value)
    {
        switch ($value) {
            case '1':
                $title = "Email Management for Generate Board";
                break;
            case '2':
                $title = "Email Management for Verification Board";
                break;
            default:
                $title = "Email Management for Approval Board";
                break;
        }

        return $title;
    }
}
