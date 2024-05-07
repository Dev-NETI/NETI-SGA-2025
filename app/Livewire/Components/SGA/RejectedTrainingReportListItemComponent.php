<?php

namespace App\Livewire\Components\SGA;

use Livewire\Attributes\Validate;
use Livewire\Component;

class RejectedTrainingReportListItemComponent extends Component
{
    public $data;
    public $vessel;
    #[Validate([
        'month' => 'required',
        'vesselType' => 'required'
    ])]
    public $month;
    public $vesselType;

    public function render()
    {
        return view('livewire.components.s-g-a.rejected-training-report-list-item-component');
    }

    public function reGenerate()
    {
        $this->validate();
        $this->dispatch('reGenerate', data:[
            'principalId' => $this->data->principal_id,
            'referenceNumber' => $this->data->reference_number,
            'month' => $this->month,
            'vesselType' => $this->vesselType
        ]);
    }
}
