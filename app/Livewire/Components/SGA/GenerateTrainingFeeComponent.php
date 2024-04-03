<?php

namespace App\Livewire\Components\SGA;

use Livewire\Component;
use App\Models\Principal;
use App\Models\Vessel_type;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Session;

class GenerateTrainingFeeComponent extends Component
{
    #[Validate([
        'month' => 'required',
        'principal' => 'required',
        'vesselType' => 'required'
    ])]
    public $month;
    public $principal;
    public $hash;
    public $vesselType;

    public function render()
    {
        $principalData = Principal::where('is_active', true)
            ->orderBy('name', 'asc')
            ->get();
        $vesselTypeData = Vessel_type::where('is_active', true)->orderBy('name','asc')->get();
        return view('livewire.components.s-g-a.generate-training-fee-component', compact('principalData','vesselTypeData'));
    }

    public function generate()
    {
            $this->validate();
            Session::put('principalId', $this->principal);
            Session::put('month', $this->month);
            Session::put('vesselTypeId', $this->vesselType);
            return $this->redirectRoute('generate.training-fee');
    }

}
