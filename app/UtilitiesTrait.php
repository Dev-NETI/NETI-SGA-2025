<?php

namespace App;

use App\Models\SummaryLog;
use App\Traits\QueryTrait;
use Illuminate\Support\Facades\Session;

trait UtilitiesTrait
{

    public function getSignature($pdf, $signaturePath, $x, $y, $w, $h)
    {
        $imagePath = storage_path('app/public/signature/' . $signaturePath);
        $pdf->Image($imagePath, $x, $y, $w, $h, 'PNG', '', '', false, 300, '', false, false, 0, false, false);
    }

    public function redirectToMaintenance($id, $route)
    {
        Session::put('processId', $id);
        return $this->redirectRoute($route);
    }
}
