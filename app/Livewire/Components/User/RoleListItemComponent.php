<?php

namespace App\Livewire\Components\User;

use Livewire\Component;
use App\Models\UserRole;
use App\Traits\QueryTrait;

class RoleListItemComponent extends Component
{
    use QueryTrait;
    public $role;
    public $user;
    public $hash;

    public function render()
    {
        return view('livewire.components.user.role-list-item-component');
        
    }

    public function store($id)
    {
        $store = UserRole::create([
            'role_id' => $id,
            'user_id' => $this->user
        ]);
        $errorMsg = "Saving role failed!";
        $successMsg = "Role saved successfully!";
        $this->storeTrait($store, $errorMsg, $successMsg);
        return $this->redirectRoute('users.roles-index', ['hash_id' => $this->hash]);
    }
}
