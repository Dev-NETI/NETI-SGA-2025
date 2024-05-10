<?php

namespace App\Livewire\Components\SGA;

use App\Models\SummaryLog;
use Livewire\Component;
use Livewire\WithPagination;

class RejectedSummaryReportListComponent extends Component
{
    use WithPagination;
    public $search;

    public function render()
    {
        $summaryLogData = SummaryLog::where('status_id', 1)
            ->where(function ($query) {
                $query->where('reference_number', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('modified_by', 'LIKE', '%' . $this->search . '%');
            })
            ->orderBy('id', 'desc')->paginate(7);

        return view('livewire.components.s-g-a.rejected-summary-report-list-component', compact('summaryLogData'));
    }
}
