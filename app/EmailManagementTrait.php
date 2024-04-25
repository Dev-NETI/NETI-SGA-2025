<?php

namespace App;

trait EmailManagementTrait
{
    public function pageTitle($value)
    {
        switch ($value) {
            case '1':
                $title = " Generate Board";
                break;
            case '2':
                $title = " Verification Board";
                break;
            default:
                $title = " Approval Board";
                break;
        }

        return $title;
    }
}
