<?php

namespace App\Livewire\Components\Logs;

use App\Models\SummaryLog;
use Livewire\Component;
use Livewire\WithPagination;

class SummaryLogListComponent extends Component
{
    use WithPagination;
    public $search;
    public $statusId;

    public function render()
    {
        $summaryLogData = SummaryLog::where('reference_number', 'LIKE', '%' . $this->search . '%')
            ->where('status_id', $this->statusId)
            ->where(function ($query) {
                $query->where('modified_by', 'LIKE', '%' . $this->search . '%');
            })
            ->orderBy('id', 'desc')->paginate(7);

        return view('livewire.components.logs.summary-log-list-component', compact('summaryLogData'));
    }
}
