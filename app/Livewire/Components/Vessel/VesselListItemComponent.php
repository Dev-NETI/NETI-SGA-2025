<?php

namespace App\Livewire\Components\Vessel;

use Exception;
use App\Models\Vessel;
use Livewire\Component;
use App\Traits\QueryTrait;
use Livewire\Attributes\Reactive;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class VesselListItemComponent extends Component
{
    use AuthorizesRequests;
    use QueryTrait;
    public $vessel;

    public function render()
    {
        return view('livewire.components.vessel.vessel-list-item-component');
    }

    public function destroy($id)
    {
        Gate::authorize('Authorize', 10);
        $data = Vessel::find($id);
        $query = $data->update([
            'is_active' => 0,
            'modified_by' => ''
        ]);

        $routeBack = "vessel.index";
        $errorMsg = "Deleting vessel failed!";
        $successMsg = "Deleting vessel successful!";

        $this->updateTrait($data, $routeBack, $query, $errorMsg, $successMsg);
        return $this->redirectRoute($routeBack);
    }
}
