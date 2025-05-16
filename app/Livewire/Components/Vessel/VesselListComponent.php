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
        $vesselData = Vessel::where('name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('code', 'LIKE', '%' . $this->search . '%')
            ->orderBy('name', 'asc')
            ->withTrashed()
            ->paginate(5);

        return view('livewire.components.vessel.vessel-list-component', compact('vesselData'));
    }
}
