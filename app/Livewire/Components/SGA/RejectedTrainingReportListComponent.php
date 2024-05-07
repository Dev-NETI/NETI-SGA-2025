<?php

namespace App\Livewire\Components\SGA;

use App\Models\Fc007Log;
use Livewire\Component;
use Livewire\WithPagination;

class RejectedTrainingReportListComponent extends Component
{
    use WithPagination;
    public $search;
    public $vessel;

    public function render()
    {
        $fc007LogData = Fc007Log::where('status_id', 1)
            ->where(function ($query) {
                $query->where('reference_number', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('modified_by', 'LIKE', '%' . $this->search . '%');
            })
            ->orderBy('id', 'desc')->paginate(7);

        return view('livewire.components.s-g-a.rejected-training-report-list-component', compact('fc007LogData'));
    }
}
