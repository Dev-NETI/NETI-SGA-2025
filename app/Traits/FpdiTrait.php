<?php

namespace App\Traits;

use TCPDF_FONTS;
use setasign\Fpdi\Tcpdf\Fpdi;

trait FpdiTrait
{

    public function initiateFpdi($creator,$author,$title)
    {
        $pdf = new Fpdi();
        $pdf->SetMargins(PDF_MARGIN_LEFT, 40, PDF_MARGIN_RIGHT);
        $pdf->SetAutoPageBreak(false, 40);
        $pdf->SetCreator($creator);
        $pdf->SetAuthor($author);
        $pdf->SetTitle($title);
        $pdf->setHeaderData('',0,'','',array(0,0,0), array(255,255,255));

        return $pdf;
    }
}
