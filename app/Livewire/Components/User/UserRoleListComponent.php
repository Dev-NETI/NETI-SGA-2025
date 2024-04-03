<?php

namespace App\Livewire\Components\User;

use App\Models\UserRole;
use Livewire\Component;
use Livewire\WithPagination;

class UserRoleListComponent extends Component
{
    use WithPagination;
    public $user;
    public $hash;
    public $search;

    public function render()
    {
        $userRoleData = UserRole::where('user_id', $this->user)
            ->whereHas('role', function ($query) {
                $query->where('name', 'LIKE', '%' . $this->search . '%');
            })
            ->paginate(6);

        return view('livewire.components.user.user-role-list-component', compact('userRoleData'));
    }
}
