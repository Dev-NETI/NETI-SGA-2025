<?php

namespace App\Livewire\Views\VesselType;

use App\Models\Vessel_type;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class VesselTypeView extends Component
{
    public $title = "Vessel Type";

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.views.vessel-type.vessel-type-view');
    }
    
    public function create($route)
    {
        return $this->redirectRoute($route);
    }
}
