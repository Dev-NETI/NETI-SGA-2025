<?php

namespace App\Livewire\Components\Logs;

use App\Models\SummaryLog;
use Livewire\Component;
use Livewire\WithPagination;

class SummaryLogListComponent extends Component
{
    use WithPagination;
    public $search;

    public function render()
    {
        $summaryLogData = SummaryLog::orderBy('id','desc')->paginate(10);
        
        return view('livewire.components.logs.summary-log-list-component', compact('summaryLogData'));
    }
}
