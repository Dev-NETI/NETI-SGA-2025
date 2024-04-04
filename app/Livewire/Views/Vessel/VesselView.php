<?php

namespace App\Livewire\Views\Vessel;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class VesselView extends Component
{
    use AuthorizesRequests;
    public $title = "Vessels";

    public function mount()
    {
        Gate::authorize('Authorize', 7);
    }

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
