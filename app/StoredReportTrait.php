<?php

namespace App;

use App\Traits\FpdiTrait;

trait StoredReportTrait
{
    use FpdiTrait;

    public function generateFC007()
    {
        // initiate fpdi
        $pdf = $this->initiateFpdi('NETI-SGA', 'NETI-SGA', "TRAINING FEE.pdf");
        $templatePath = storage_path('app/public/F-FC-007/20240425025017-4107349325.pdf');
        $template = $pdf->setSourceFile($templatePath);
        $importedPage = $pdf->importPage($template);
        $pageWidth = 210;
        $pageHeight = 297;
        
        $pdf->AddPage('P', [$pageWidth, $pageHeight]);
        $pdf->useTemplate($importedPage);

        $pdf->Output();
    }

}
