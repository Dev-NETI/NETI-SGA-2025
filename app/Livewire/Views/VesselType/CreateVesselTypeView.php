<?php

namespace App\Livewire\Views\VesselType;

use App\Models\Vessel_type;
use App\Traits\QueryTrait;
use Exception;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateVesselTypeView extends Component
{
    use QueryTrait;
    public $title = 'Create Vessel Type';
    public $hash = NULL;
    public $vesselTypeId;

    #[Validate('required|min:2')]
    public $vesselType;

    public function mount($hash_id = null)
    {
        if ($hash_id != null) {
            $this->hash = $hash_id;
            $vesselTypeData = Vessel_type::where('hash', $this->hash)->first();
            $this->vesselType = $vesselTypeData->name;
            $this->vesselTypeId = $vesselTypeData->id;
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.views.vessel-type.create-vessel-type-view');
    }

    public function store()
    {
        $this->validate();
        $query = Vessel_type::create([
            'hash' => '',
            'name' => $this->vesselType
        ]);
        $errorMsg = "Saving vessel type failed!";
        $successMsg = "Saving vessel type successful!";
        $route = "vessel-type.index";

        $this->storeTrait($query, $errorMsg, $successMsg);
        return $this->redirectRoute($route);
    }

    public function update()
    {
        $this->validate();
        $data = Vessel_type::find($this->vesselTypeId);
        $query = $data->update([
            'name' => $this->vesselType
        ]);
        $routeBack = "vessel-type.index";
        $errorMsg = "Updating Vessel type failed!";
        $successMsg = "Updating Vessel type success!";

        $this->updateTrait($data,$routeBack,$query, $errorMsg, $successMsg);
        return $this->redirectRoute($routeBack);
    }
}
