<?php

namespace App\Livewire\Reports\SGA;

use TCPDF_FONTS;
use Carbon\Carbon;
use NumberFormatter;
use App\Models\Vessel;
use Livewire\Component;
use App\Models\Principal;
use App\Models\Recipient;
use App\Models\User;
use App\Models\Vessel_type;
use Illuminate\Support\Str;
use setasign\Fpdi\Tcpdf\Fpdi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use TCPDF;

class LetterComponent extends Component
{
    public function render()
    {
        return view('livewire.reports.s-g-a.letter-component');
    }

    public function generate()
    {
        // session
        $month = Session::get('month');
        $principalId = Session::get('principalId');
        $principalData = Principal::find($principalId);
        $recipientId = Session::get('recipientId');
        $recipientData = Recipient::find($recipientId);
        $userId = Session::get('userlId');
        $userData = User::find($userId);
        //vessel type data
        $vesselTypeData = Vessel_type::whereHas('vessel', function ($query) use ($principalId) {
            $query->where('principal_id', $principalId);
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

        $pdf = new Fpdi();
        $pdf->SetMargins(PDF_MARGIN_LEFT, 40, PDF_MARGIN_RIGHT);
        $pdf->SetAutoPageBreak(false, 40);
        $pdf->SetCreator('NETI-SGA');
        $pdf->SetAuthor('NETI-SGA');
        $pdf->SetTitle('Training Fee Summary and Letter');

        // template
        $templatePath = storage_path('app/public/SGA/SGA-Letter.pdf');
        $template = $pdf->setSourceFile($templatePath);
        $importedPage = $pdf->importPage($template);

        // LETTER PAGE
        // LETTER PAGE
        $pdf->AddPage('P');

        $pdf->useTemplate($importedPage);
        // Set font
        $pdf->SetFont('Helvetica', 'B', 9);

        // current date
        $pdf->setXY(24, 28);
        $pdf->Cell(30, 0, Carbon::now()->format('Y F d'), 0, 0, "L");

        // Principal
        $pdf->setXY(24, 35);
        $pdf->Cell(80, 0, $principalData->name, 0, 0, "L");
        // Encode the address as HTML with preserved line breaks
        $addressHtml = nl2br(htmlspecialchars($principalData->address));
        $pdf->writeHTMLCell(80, 0, 24, 39, $addressHtml, 0, 0, false, true, 'L');

        // recipient
        $pdf->setXY(60, 56);
        $pdf->Cell(80, 0, $principalData->recipient[0]->name, 0, 0, "L");
        $pdf->setXY(60, 60);
        $pdf->Cell(80, 0, $principalData->recipient[0]->position, 0, 0, "L");
        $pdf->setXY(60, 64);
        $pdf->Cell(80, 0, $principalData->recipient[0]->department, 0, 0, "L");

        // content
        $htmlContent = "Dear Sir:
                    
                    We are please to enclose herewith our Statement of General Accounts (SGA) in the total amount of US Dollars: " . Str::upper($formattedStringTotalTrainingFee) . " (USD " . $formattedTotalTrainingFee . ") which covers Training Fees for the following types of vessel for the month of " . $formattedMonth . ".";
        // Encode the address as HTML with preserved line breaks
        $conentHtml = nl2br(htmlspecialchars($htmlContent));
        $pdf->writeHTMLCell(165, 0, 24, 71, $conentHtml, 0, 0, false, true, 'J');

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
        $pdf->Cell(25, 0, Str::upper($userData->full_name), 0, 0, "L");
        $pdf->setXY(24, 226);
        $pdf->Cell(25, 0, $userData->position->name, 0, 0, "L");

        // Display the PNG image
        $imagePath = storage_path('app/public/signature/' . $userData->signature_path);
        $pdf->Image($imagePath, 35, 203, 44, 22, 'PNG', '', '', false, 300, '', false, false, 0, false, false);

        

        // LETTER PAGE END
        // LETTER PAGE END

        $pdf->Output();
    }
}
