<?php

namespace App\Livewire\Components\User;

use Livewire\Component;
use App\Models\UserRole;
use App\Traits\QueryTrait;

class UserRoleListItemComponent extends Component
{
    use QueryTrait;
    public $user;
    public $hash;
    public $role;

    public function render()
    {
        return view('livewire.components.user.user-role-list-item-component');
    }

    public function destroy($id)
    {
        $userRoleData = UserRole::find($id);
        $destroy = $userRoleData->delete();
        $errorMsg = "Deleting role failed!";
        $successMsg = "Role deleted successfully!";
        $routeBack = "users.index";
        $this->updateTrait($userRoleData, $routeBack, $destroy, $errorMsg, $successMsg);
        return $this->redirectRoute('users.roles-index', ['hash_id' => $this->hash]);
    }
}
