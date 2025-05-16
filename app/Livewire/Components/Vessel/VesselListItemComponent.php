<?php

namespace App\Livewire\Components\Vessel;

use Exception;
use App\Models\Vessel;
use Livewire\Component;
use App\Traits\QueryTrait;
use Livewire\Attributes\Reactive;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class VesselListItemComponent extends Component
{
    use AuthorizesRequests;
    use QueryTrait;
    public $vessel;

    public function render()
    {
        return view('livewire.components.vessel.vessel-list-item-component');
    }

    public function toggleActive($id)
    {
        Gate::authorize('Authorize', 10);
        $data = Vessel::where('id', $id)->withTrashed()->first();
        $query = $this->vessel->deleted_at ? $data->restore() : $data->delete();

        $routeBack = "vessel.index";

        if (!$query) {
            session()->flash('error', 'Transaction failed!');
        }
        session()->flash('success', $this->vessel->deleted_at ? 'Vessel activated successfully!' : 'Vessel deactivated successfully!!');

        return $this->redirectRoute($routeBack);
    }
}
