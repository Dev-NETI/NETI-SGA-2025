<?php

namespace App\Livewire\Components\VesselType;

use App\Models\Vessel_type;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class VesselTypeListComponent extends Component
{
    use WithPagination;
    public $search;

    public function render()
    {
        $vesselTypeData = Vessel_type::where('is_active', true)
            ->where('name', 'LIKE', '%' . $this->search . '%')
            ->orderBy('name', 'asc')
            ->paginate(5);
        return view('livewire.components.vessel-type.vessel-type-list-component', compact('vesselTypeData'));
    }
}
