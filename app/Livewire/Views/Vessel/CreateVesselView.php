<?php

namespace App\Livewire\Views\Vessel;

use App\Models\Vessel;
use App\Models\Vessel_type;
use Exception;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateVesselView extends Component
{
    public $hash;

    #[Validate([
        'vessel' => 'required|min:2',
        'vesselType' => 'required',
        'code' => 'required|min:2',
        'trainingFee' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/'
    ])]
    public $vessel;
    public $vesselType;
    public $code;
    public $trainingFee;

    public function mount($hash = null)
    {
        if ($hash != null) {
            $this->hash = $hash;
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $vesselTypeData = Vessel_type::where('is_active', 1)->orderBy('name', 'asc')->get();
        return view('livewire.views.vessel.create-vessel-view', compact('vesselTypeData'));
    }

    public function store()
    {
        $this->validate();

        try {
            $create = Vessel::create([
                'vessel_type_id' => $this->vesselType,
                'hash' => '',
                'name' => $this->vessel,
                'code' => $this->code,
                'training_fee' => $this->trainingFee,
                'modified_by' => ''
            ]);

            if (!$create) {
                session()->flash('error', 'Saving vessel failed!');
            }

            session()->flash('success', 'Vessel saved successfully!');
            return $this->redirectRoute('vessel.index', navigate: true);
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }
}
