<?php

namespace App\Livewire\Components\Vessel;

use Exception;
use App\Models\Vessel;
use Livewire\Component;
use Livewire\Attributes\Reactive;

class VesselListItemComponent extends Component
{
    public $vessel;

    public function render()
    {
        return view('livewire.components.vessel.vessel-list-item-component');
    }

    public function destroy($id)
    {
        try {
            $vesselData = Vessel::find($id);
            $update = $vesselData->update([
                'is_active' => 0,
                'modified_by' => ''
            ]);

            if (!$update) {
                session()->flash('error', 'Deleting vessel failed!');
            }

            session()->flash('success', 'Vessel deleted successfully!');
            return $this->redirectRoute('vessel.index', navigate: true);
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

}
