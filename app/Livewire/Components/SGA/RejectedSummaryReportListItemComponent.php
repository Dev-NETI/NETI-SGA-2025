<?php

namespace App\Livewire\Components\SGA;

use App\Models\Company;
use Livewire\Attributes\Validate;
use Livewire\Component;

class RejectedSummaryReportListItemComponent extends Component
{
    public $data;
    public $principal;
    public $hash="not null";
    #[Validate([
        'month' => 'required',
        'principal' => 'required'
    ])]
    public $month;
    
    public function mount()
    {
        $this->principal = $this->data->principal_id;
        $this->hash = $this->data->hash;
    }

    public function render()
    {
        $principalData = Company::where('is_principal', 1)->where('is_active', 1)->get();
        
        return view('livewire.components.s-g-a.rejected-summary-report-list-item-component', compact('principalData'));
    }

    public function reGenerate()
    {
        $this->validate();
        $this->dispatch('reGenerate', data: [
            'principalId' => $this->principal,
            'referenceNumber' => $this->data->reference_number,
            'month' => $this->month
        ]);
    }
}
