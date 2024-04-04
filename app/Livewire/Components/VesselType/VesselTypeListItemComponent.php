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

    public function destroy($id)
    {
        Gate::authorize('Authorize', 14);
        $data = Vessel_type::find($id);
        $query = $data->update([
            'is_active' => 0,
        ]);
        $routeBack = "vessel-type.index";
        $errorMsg = "Deleting Vessel type failed!";
        $successMsg = "Deleting Vessel type successful!";

        $this->updateTrait($data, $routeBack, $query, $errorMsg, $successMsg);
        return $this->redirectRoute($routeBack);
    }
}
