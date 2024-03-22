<?php

namespace App\Livewire\Components\Recipient;

use App\Models\Recipient;
use App\Traits\QueryTrait;
use Livewire\Component;

class RecipientListItemComponent extends Component
{
    use QueryTrait;
    public $recipient;

    public function render()
    {
        return view('livewire.components.recipient.recipient-list-item-component');
    }

    public function destroy($id)
    {
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
