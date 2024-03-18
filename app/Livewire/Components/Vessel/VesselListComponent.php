<?php

namespace App\Livewire\Components\Vessel;

use App\Models\Vessel;
use Livewire\Component;
use Livewire\WithPagination;

class VesselListComponent extends Component
{
    use WithPagination;
    public $search;

    public function render()
    {
        $vesselData = Vessel::where('is_active', 1)
            ->where('name','LIKE','%'.$this->search.'%')
            ->orderBy('name', 'asc')
            ->paginate(5);

        return view('livewire.components.vessel.vessel-list-component', compact('vesselData'));
    }
}
