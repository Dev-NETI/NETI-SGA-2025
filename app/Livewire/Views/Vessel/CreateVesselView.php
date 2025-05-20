<?php

namespace App\Livewire\Views\Vessel;

use App\Models\Company;
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
    ])]
    public $vessel;
    public $vesselType;
    public $prefix = "";
    public $code;
    public $vesselId;
    public $principal;
    public $serialNumber;
    public $remarks;

    public function mount($hash_id = null)
    {
        if ($hash_id != null) {
            $this->hash = $hash_id;
            $vesselData = Vessel::where('hash', $this->hash)->withTrashed()->first();
            $this->vessel = $vesselData->name;
            $this->vesselType = $vesselData->vessel_type_id;
            $this->code = $vesselData->code;
            $this->vesselId = $vesselData->id;
            $this->principal = $vesselData->principal_id;
            $this->serialNumber = $vesselData->serial_number;
            $this->remarks = $vesselData->remarks;
            $this->prefix = $vesselData->prefix;
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $vesselTypeData = Vessel_type::withTrashed()->orderBy('name', 'asc')->get();
        $principalData = Company::where('is_active', 1)->where('is_principal', 1)->orderBy('name', 'asc')->get();
        return view('livewire.views.vessel.create-vessel-view', compact('vesselTypeData', 'principalData'));
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
            'principal_id' => $this->principal,
            'remarks' => $this->remarks,
            'prefix' => $this->prefix,
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

        $data = Vessel::where('id', $this->vesselId)->withTrashed()->first();
        $query = $data->update([
            'vessel_type_id' => $this->vesselType,
            'name' => $this->vessel,
            'code' => $this->code,
            'principal_id' => $this->principal,
            'serial_number' => $this->serialNumber,
            'remarks' => $this->remarks,
            'prefix' => $this->prefix,
        ]);

        $routeBack = "vessel.index";
        $errorMsg = "Updating vessel failed!";
        $successMsg = "Updating vessel successful!";

        $this->updateTrait($data, $routeBack, $query, $errorMsg, $successMsg);
        return $this->redirectRoute($routeBack);
    }
}
