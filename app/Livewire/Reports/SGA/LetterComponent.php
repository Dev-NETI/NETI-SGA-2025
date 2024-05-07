<?php

namespace App\Livewire\Reports\SGA;

use App\SummaryTrait;
use Livewire\Component;
use Illuminate\Support\Facades\Session;


class LetterComponent extends Component
{
    use SummaryTrait;

    public function generate()
    {
        $month = Session::get('month');
        $principalId = Session::get('principalId');
        $recipientId = Session::get('recipientId');
        $this->generateSummary($month, $principalId, $recipientId);
    }

}
