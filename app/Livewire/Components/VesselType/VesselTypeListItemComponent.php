<?php

namespace App\Livewire\Components\VesselType;

use App\Livewire\Views\VesselType\VesselTypeView;
use App\Models\Vessel_type;
use App\Traits\QueryTrait;
use Exception;
use Livewire\Component;

class VesselTypeListItemComponent extends Component
{
    use QueryTrait;
    public $vessel;

    public function render()
    {
        return view('livewire.components.vessel-type.vessel-type-list-item-component');
    }

    public function destroy($id)
    {
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
