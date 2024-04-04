<?php

namespace App\Livewire\Components\Recipient;

use Livewire\Component;
use App\Models\Recipient;
use App\Traits\QueryTrait;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RecipientListItemComponent extends Component
{
    use AuthorizesRequests;
    use QueryTrait;
    public $recipient;

    public function render()
    {
        return view('livewire.components.recipient.recipient-list-item-component');
    }

    public function destroy($id)
    {
        Gate::authorize('Authorize', 22);
        $data = Recipient::find($id);
        $query = $data->update([
            'is_active' => 0,
            'modified_by' => ''
        ]);

        $routeBack = "recipient.index";
        $errorMsg = "Deleting recipient failed!";
        $successMsg = "Deleting recipient successful!";

        $this->updateTrait($data, $routeBack, $query, $errorMsg, $successMsg);
        return $this->redirectRoute($routeBack);
    }

}
