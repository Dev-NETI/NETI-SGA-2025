<?php

namespace App\Livewire\Components\User;

use App\Models\User;
use App\Traits\QueryTrait;
use Exception;
use Livewire\Component;

class UserListItemComponent extends Component
{
    use QueryTrait;
    public $user;

    public function render()
    {
        return view('livewire.components.user.user-list-item-component');
    }

    public function destroy($id)
    {
        $data = User::find($id);
        $query = $data->update([
            'is_active' => false,
        ]);
        $routeBack = "users.index";
        $errorMsg = "Deleting user failed!";
        $successMsg = "Deleting user successful!";

        $this->updateTrait($data, $routeBack, $query, $errorMsg, $successMsg);
        return $this->redirectRoute($routeBack);
    }
}
