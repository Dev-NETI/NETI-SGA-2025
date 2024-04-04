<?php

namespace App\Livewire\Components\SGA;

use Livewire\Component;
use App\Models\Principal;
use App\Models\Vessel_type;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class GenerateTrainingFeeComponent extends Component
{
    use AuthorizesRequests;
    #[Validate([
        'month' => 'required',
        'principal' => 'required',
        'vesselType' => 'required'
    ])]
    public $month;
    public $principal;
    public $hash;
    public $vesselType;
    public $isGenerated = 0;

    public function render()
    {
        $principalData = Principal::where('is_active', true)
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
        $this->isGenerated = 1;
        // return $this->redirectRoute('generate.training-fee');
    }
}
