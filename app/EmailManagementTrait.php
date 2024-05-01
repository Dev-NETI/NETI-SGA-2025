<?php

namespace App;

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
}
