<?php

namespace App\Livewire\Components\Principal;

use Livewire\Component;
use App\Models\Principal;
use App\Traits\QueryTrait;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PrincipalListItemComponent extends Component
{
    use AuthorizesRequests;
    use QueryTrait;

    public $principal;
    public function render()
    {
        return view('livewire.components.principal.principal-list-item-component');
    }

    public function destroy($id)
    {
        Gate::authorize('Authorize', 18);
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
