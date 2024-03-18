<?php

namespace App\Livewire\Components\VesselType;

use App\Livewire\Views\VesselType\VesselTypeView;
use App\Models\Vessel_type;
use Exception;
use Livewire\Component;

class VesselTypeListItemComponent extends Component
{
    public $vessel;

    public function render()
    {
        return view('livewire.components.vessel-type.vessel-type-list-item-component');
    }

    public function destroy($id)
    {
        try {
            $vesselTypeData = Vessel_type::find($id);
            if (!$vesselTypeData) {
                session()->flash('error', 'Vessel type data not found');
            }

            $update = $vesselTypeData->update([
                'is_active' => 0,
            ]);

            if (!$update) {
                session()->flash('error', 'Deleting vessel type failed!');
            }

            session()->flash('success', 'Vessel type deleted successfully!');
            return $this->redirect(VesselTypeView::class, navigate:true);
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }
}
