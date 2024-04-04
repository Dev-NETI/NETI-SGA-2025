<?php

namespace App\Livewire\Views\Vessel;

use Exception;
use App\Models\Vessel;
use Livewire\Component;
use App\Models\Principal;
use App\Traits\QueryTrait;
use App\Models\Vessel_type;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CreateVesselView extends Component
{
    use AuthorizesRequests;
    use QueryTrait;
    public $hash;

    #[Validate([
        'vessel' => 'required|min:2',
        'vesselType' => 'required',
        'code' => 'required|min:2',
        'principal' => 'required',
        'trainingFee' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
    ])]
    public $vessel;
    public $vesselType;
    public $code;
    public $trainingFee;
    public $vesselId;
    public $principal;
    public $serialNumber;
    public $remarks;

    public function mount($hash_id = null)
    {
        if ($hash_id != null) {
            $this->hash = $hash_id;
            $vesselData = Vessel::where('hash', $this->hash)->first();
            $this->vessel = $vesselData->name;
            $this->vesselType = $vesselData->vessel_type_id;
            $this->code = $vesselData->code;
            $this->trainingFee = $vesselData->training_fee;
            $this->vesselId = $vesselData->id;
            $this->principal = $vesselData->principal_id;
            $this->serialNumber = $vesselData->serial_number;
            $this->remarks = $vesselData->remarks;
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $vesselTypeData = Vessel_type::where('is_active', 1)->orderBy('name', 'asc')->get();
        $principalData = Principal::where('is_active', 1)->orderBy('name', 'asc')->get();
        return view('livewire.views.vessel.create-vessel-view', compact('vesselTypeData','principalData'));
    }

    public function store()
    {
        Gate::authorize('Authorize', 8);
        $this->validate();
        $query = Vessel::create([
            'vessel_type_id' => $this->vesselType,
            'hash' => '',
            'name' => $this->vessel,
            'code' => $this->code,
            'training_fee' => $this->trainingFee,
            'principal_id' => $this->principal,
            'remarks' => $this->remarks,
        ]);
        $errorMsg = "Saving vessel failed!";
        $successMsg = "Saving vessel successful!";
        $route = "vessel.index";

        $this->storeTrait($query, $errorMsg, $successMsg);
        return $this->redirectRoute($route);
    }

    public function update()
    {
        Gate::authorize('Authorize', 9);
        $this->validate();

        $data = Vessel::find($this->vesselId);
        $query = $data->update([
            'vessel_type_id' => $this->vesselType,
            'name' => $this->vessel,
            'code' => $this->code,
            'training_fee' => $this->trainingFee,
            'principal_id' => $this->principal,
            'serial_number' => $this->serialNumber,
            'remarks' => $this->remarks,
        ]);

        $routeBack = "vessel.index";
        $errorMsg = "Updating vessel failed!";
        $successMsg = "Updating vessel successful!";

        $this->updateTrait($data,$routeBack,$query, $errorMsg, $successMsg);
        return $this->redirectRoute($routeBack);
    }
}
