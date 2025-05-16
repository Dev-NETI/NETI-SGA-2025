<?php

namespace App\Livewire\Components\VesselType;

use Exception;
use Livewire\Component;
use App\Traits\QueryTrait;
use App\Models\Vessel_type;
use Illuminate\Support\Facades\Gate;
use App\Livewire\Views\VesselType\VesselTypeView;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class VesselTypeListItemComponent extends Component
{
    use AuthorizesRequests;
    use QueryTrait;
    public $vessel;

    public function render()
    {
        return view('livewire.components.vessel-type.vessel-type-list-item-component');
    }

    public function toggleActive($id)
    {
        Gate::authorize('Authorize', 14);
        $data = Vessel_type::where('id', $id)->withTrashed()->first();
        $query = $this->vessel->deleted_at ? $data->restore() : $data->delete();

        $routeBack = "vessel-type.index";
        if (!$query) {
            session()->flash('error', 'Transaction failed!');
        }
        session()->flash('success', $this->vessel->deleted_at ? 'Vessel Type activated successfully!' : 'Vessel Type deactivated successfully!!');

        return $this->redirectRoute($routeBack);
    }
}
