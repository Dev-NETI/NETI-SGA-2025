<?php

namespace App;

use App\Models\Fc007Log;
use App\Traits\FpdiTrait;
use App\Traits\QueryTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

trait StoredReportTrait
{
    use QueryTrait;
    use UtilitiesTrait;
    use FpdiTrait;

    public function generateFC007($fcLogId, $referenceNumber, $output = true, $processId = null)
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

            $this->getSignature($pdf, Auth::user()->signature_path, 90, 269, 12, 12);

            $pdf->useTemplate($importedPage);
        }

        if ($output == true) {
            $pdf->Output();
        } else {

            //delete old file
            $deleteFile = Storage::disk('public')->delete('F-FC-007/' . $referenceNumber . '.pdf');
            
            if(!$deleteFile){
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
                $query = Fc007Log::find($fcLogId);
                $update = $query->update([
                    'status_id' => 3
                ]);

                $this->updateTrait($query,'sga.process-fc007',$update, "Sending file failed!", "File sent successfully!");
                return $this->redirectRoute('sga.process-fc007',['processId'=>$processId]);

            }

        }
    }
}
