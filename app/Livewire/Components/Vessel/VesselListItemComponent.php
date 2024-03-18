<?php

namespace App\Livewire\Components\Vessel;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class VesselListItemComponent extends Component
{
    public $vessel;

    public function render()
    {
        return view('livewire.components.vessel.vessel-list-item-component');
    }
}
