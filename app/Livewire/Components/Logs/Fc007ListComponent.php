<?php

namespace App\Livewire\Components\Logs;

use App\Models\Fc007Log;
use Livewire\Component;
use Livewire\WithPagination;

class Fc007ListComponent extends Component
{
    use WithPagination;
    public $search;
    public $statusId;

    public function render()
    {
        $fc007LogData = Fc007Log::where('status_id', $this->statusId)
            ->where(function ($query) {
                $query->where('reference_number', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('modified_by', 'LIKE', '%' . $this->search . '%');
            })
            ->orderBy('id', 'desc')->paginate(7);
            
        return view('livewire.components.logs.fc007-list-component', compact('fc007LogData'));
    }
}
