<?php

namespace App\Livewire\Views\VesselType;

use App\Models\Vessel_type;
use Exception;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateVesselTypeView extends Component
{
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
        try {
            $store = Vessel_type::create([
                'hash' => '',
                'name' => $this->vesselType
            ]);
            if (!$store) {
                session()->flash('error', 'Saving data failed!');
            }
            session()->flash('success', 'Vessel Type saved successfully!');
            return $this->redirect(VesselTypeView::class, navigate: true);
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function update()
    {
        $this->validate();
        try {
            $vesselTypeData = Vessel_type::find($this->vesselTypeId);

            if (!$vesselTypeData) {
                session()->flash('error', 'Vessel Type data not found!');
            }

            $update = $vesselTypeData->update([
                'name' => $this->vesselType
            ]);
            if (!$update) {
                session()->flash('error', 'Updating data failed!');
            }
            session()->flash('success', 'Vessel Type updated successfully!');
            return $this->redirect(VesselTypeView::class, navigate: true);
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }
}
