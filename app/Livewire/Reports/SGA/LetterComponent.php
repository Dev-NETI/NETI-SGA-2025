<?php

namespace App\Livewire\Reports\SGA;

use Illuminate\Support\Facades\Session;
use Livewire\Component;
use setasign\Fpdi\Tcpdf\Fpdi;
use TCPDF_FONTS;

class LetterComponent extends Component
{
    public function render()
    {
        return view('livewire.reports.s-g-a.letter-component');
    }

    public function generate()
    {
        $month = Session::get('month');

        $pdf = new Fpdi();
        $pdf->SetMargins(PDF_MARGIN_LEFT, 40, PDF_MARGIN_RIGHT);
        $pdf->SetAutoPageBreak(false, 40);
        $pdf->SetCreator('NETI-SGA');
        $pdf->SetAuthor('NETI-SGA');
        $pdf->SetTitle('Training Fee Summary and Letter');

        // template
        $templatePath = storage_path('SGA/SGA-Letter.pdf');
    }
}
