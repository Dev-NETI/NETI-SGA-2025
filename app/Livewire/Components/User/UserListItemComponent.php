<?php

namespace App\Livewire\Components\User;

use Exception;
use App\Models\User;
use Livewire\Component;
use App\Traits\QueryTrait;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserListItemComponent extends Component
{
    use AuthorizesRequests;
    use QueryTrait;
    public $user;

    public function render()
    {
        return view('livewire.components.user.user-list-item-component');
    }

    public function destroy($id)
    {
        Gate::authorize('Authorize', 27);
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
