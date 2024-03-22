<?php

namespace App\Livewire\Components\Principal;

use Livewire\Component;
use App\Models\Principal;
use App\Traits\QueryTrait;

class PrincipalListItemComponent extends Component
{
    use QueryTrait;

    public $principal;
    public function render()
    {
        return view('livewire.components.principal.principal-list-item-component');
    }

    public function destroy($id)
    {
        $data = Principal::find($id);
        $query = $data->update([
            'is_active' => false,
        ]);
        $routeBack = "principal.index";
        $errorMsg = "Deleting principal failed!";
        $successMsg = "Deleting principal successful!";

        $this->updateTrait($data, $routeBack, $query, $errorMsg, $successMsg);
        return $this->redirectRoute($routeBack);
    }
}
