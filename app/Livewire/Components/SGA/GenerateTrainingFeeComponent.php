<?php

namespace App\Livewire\Components\SGA;

use App\FC007Trait;
use App\Models\Company;
use App\Models\Fc007ReportEmailRecipient;
use Livewire\Component;
use App\Models\Principal;
use App\Models\Vessel_type;
use App\Traits\UtilitiesTrait;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class GenerateTrainingFeeComponent extends Component
{
    use AuthorizesRequests;
    use UtilitiesTrait;
    use FC007Trait;
    #[Validate([
        'month' => 'required',
        'principal' => 'required',
        'vesselType' => 'required'
    ])]
    public $month;
    public $principal;
    public $hash;
    public $vesselType;
    public $isGenerated;
    public $referenceNumber;

    public function render()
    {
        $principalData = Company::where('is_active', true)->where('is_principal', true)
            ->orderBy('name', 'asc')
            ->get();
        $vesselTypeData = Vessel_type::where('is_active', true)->orderBy('name', 'asc')->get();
        return view('livewire.components.s-g-a.generate-training-fee-component', compact('principalData', 'vesselTypeData'));
    }

    public function generate()
    {
        Gate::authorize('Authorize', 5);
        $this->validate();
        Session::put('principalId', $this->principal);
        Session::put('month', $this->month);
        Session::put('vesselTypeId', $this->vesselType);
        $this->isGenerated = true;
        $this->referenceNumber = $this->generateReferenceNumber();
    }

    public function storeLog()
    {
        $sessionPrincipalId = Session::get('principalId', $this->principal);
        $sessionMonth = Session::get('month', $this->month);
        $sessionVesselTypeId = Session::get('vesselTypeId', $this->vesselType);
        $this->generateFC007($sessionPrincipalId, $sessionMonth, $sessionVesselTypeId, false, $this->referenceNumber);
    }
}
