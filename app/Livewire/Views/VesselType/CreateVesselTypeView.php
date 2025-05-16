<?php

namespace App\Livewire\Views\VesselType;

use Exception;
use Livewire\Component;
use App\Traits\QueryTrait;
use App\Models\Vessel_type;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CreateVesselTypeView extends Component
{
    use AuthorizesRequests;
    use QueryTrait;
    public $title = 'Create Vessel Type';
    public $hash = NULL;
    public $vesselTypeId;


    #[Validate('required|min:2')]
    public $vesselType;
    #[Validate('required|numeric|min:0.01')]
    public $trainingFee;

    public function mount($hash_id = null)
    {
        if ($hash_id != null) {
            $this->hash = $hash_id;
            $vesselTypeData = Vessel_type::where('hash', $this->hash)->first();
            $this->vesselType = $vesselTypeData->name;
            $this->trainingFee = $vesselTypeData->training_fee;
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
        Gate::authorize('Authorize', 12);
        $this->validate();
        $query = Vessel_type::create([
            'hash' => '',
            'name' => $this->vesselType,
            'training_fee' => $this->trainingFee
        ]);
        $errorMsg = "Saving vessel type failed!";
        $successMsg = "Saving vessel type successful!";
        $route = "vessel-type.index";

        $this->storeTrait($query, $errorMsg, $successMsg);
        return $this->redirectRoute($route);
    }

    public function update()
    {
        Gate::authorize('Authorize', 13);
        $this->validate();
        $data = Vessel_type::find($this->vesselTypeId);
        $query = $data->update([
            'name' => $this->vesselType,
            'training_fee' => $this->trainingFee
        ]);
        $routeBack = "vessel-type.index";
        $errorMsg = "Updating Vessel type failed!";
        $successMsg = "Updating Vessel type success!";

        $this->updateTrait($data, $routeBack, $query, $errorMsg, $successMsg);
        return $this->redirectRoute($routeBack);
    }
}
