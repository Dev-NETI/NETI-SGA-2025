<?php

namespace App\Livewire\Reports\SGA;

use App\StoredReportTrait;
use App\SummaryTrait;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class GenerateStoredSummaryReportComponent extends Component
{
    use SummaryTrait;

    public function __invoke()
    {
        $this->generateSummary(
            Session::get('month'),
            Session::get('principalId'),
            Session::get('recipientId'),
            true,
            Session::get('referenceNumber'),
            Session::get('currentProcessId'),
            Session::get('generatedUserId'),
            Session::get('verifiedUserId'),
            Session::get('approvedUserId')
        );
    }
}
