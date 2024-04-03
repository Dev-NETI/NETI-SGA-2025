<?php

namespace App\Livewire\Components\User;

use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;

class RoleListComponent extends Component
{
    use WithPagination;
    public $search;
    public $user;
    public $hash;

    public function render()
    {
        $roleData = Role::where('is_active', true)
            ->where('name', 'LIKE', '%' . $this->search . '%')
            ->orderBy('id', 'asc')
            ->paginate(6);

        return view('livewire.components.user.role-list-component', compact('roleData'));
    }
}
