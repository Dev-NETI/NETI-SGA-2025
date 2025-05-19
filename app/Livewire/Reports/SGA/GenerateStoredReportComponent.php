<?php

namespace App\Livewire\Reports\SGA;

use Livewire\Component;
use App\StoredReportTrait;
use Illuminate\Support\Facades\Session;

class GenerateStoredReportComponent extends Component
{
    use StoredReportTrait;

    public function __invoke()
    {
        $fcLogId = Session::get('logId');
        $referenceNumber = Session::get('referenceNumber');
        $processId = Session::get('processId');
        $this->generateFC007($fcLogId, $referenceNumber, true, $processId);
    }
}
