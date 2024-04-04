<?php

namespace App\Livewire\Views\VesselType;

use Livewire\Component;
use App\Models\Vessel_type;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Gate;

class VesselTypeView extends Component
{
    use AuthorizesRequests;
    public $title = "Vessel Type";

    public function mount()
    {
        Gate::authorize('Authorize', 11);
    }

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
