<?php

namespace App\Livewire\Components\SGA;

use App\FC007Trait;
use App\Models\Company;
use App\Models\Fc007Log;
use App\Models\Vessel;
use Livewire\Component;
use App\Models\Vessel_type;
use App\Traits\QueryTrait;
use App\Traits\UtilitiesTrait;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\On;

class GenerateTrainingFeeComponent extends Component
{
    use AuthorizesRequests;
    use UtilitiesTrait;
    use FC007Trait;
    use QueryTrait;
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
    public $rejectedList = false;
    public $reGenerate = false;

    public function render()
    {
        $sentBackBoardCount = count(Fc007Log::where('status_id', 1)->get());
        $principalData = Company::where('is_active', true)->where('is_principal', true)
            ->orderBy('name', 'asc')
            ->get();
        $vesselTypeData = Vessel_type::withTrashed()->orderBy('name', 'asc')->get();
        return view('livewire.components.s-g-a.generate-training-fee-component', compact('principalData', 'vesselTypeData', 'sentBackBoardCount'));
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

    #[On('reGenerate')]
    public function reGenerate($data)
    {
        $this->cancelRejectedList();

        Gate::authorize('Authorize', 5);
        Session::put('principalId', $data['principalId']);
        Session::put('month', $data['month']);
        Session::put('vesselTypeId', $data['vesselType']);
        $this->reGenerate = true;
        $this->isGenerated = true;
        $this->referenceNumber = $data['referenceNumber'];
    }

    public function storeLog($reGenerate = false)
    {
        if ($reGenerate) {
            //delete old file
            $deleteFile = Storage::disk('public')->delete('F-FC-007/' . $this->referenceNumber . '.pdf');
            if ($deleteFile) {
                $this->hardDestroyTrait(Fc007Log::class, 'reference_number', $this->referenceNumber);
            }
        }

        $sessionPrincipalId = Session::get('principalId', $this->principal);
        $sessionMonth = Session::get('month', $this->month);
        $sessionVesselTypeId = Session::get('vesselTypeId', $this->vesselType);
        $this->generateFC007(
            $sessionPrincipalId,
            $sessionMonth,
            $sessionVesselTypeId,
            false,
            $this->referenceNumber
        );
    }

    public function cancel()
    {
        $this->isGenerated = false;
    }

    public function showRejected()
    {
        $this->rejectedList = true;
    }

    public function cancelRejectedList()
    {
        $this->rejectedList = false;
    }
}
