<?php

namespace App\Livewire\Views\Vessel;

use Livewire\Attributes\Layout;
use Livewire\Component;

class VesselView extends Component
{
    public $title = "Vessels";
    
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.views.vessel.vessel-view');
    }
    
    public function create($route)
    {
        return $this->redirectRoute($route);
    }
    
}
