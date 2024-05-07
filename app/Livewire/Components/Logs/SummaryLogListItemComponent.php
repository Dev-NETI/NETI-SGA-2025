<?php

namespace App\Livewire\Components\Logs;

use Livewire\Component;
use App\Models\SummaryLog;
use Illuminate\Support\Facades\Redirect;

class SummaryLogListItemComponent extends Component
{
    public $summary;
    
    public function render()
    {
        return view('livewire.components.logs.summary-log-list-item-component');
    }

    public function show()
    {
        $this->dispatch('generate', data:$this->summary);
    }
}
