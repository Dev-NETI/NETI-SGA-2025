<?php

namespace App\Livewire\Views\User;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Livewire\Attributes\Layout;
use Livewire\Component;

class AssignRolesView extends Component
{
    public $title;
    public $hash;
    public $userId;

    public function mount($hash_id = null)
    {
        if ($hash_id != NULL) {
            $this->hash = $hash_id;
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $userData = User::where('hash', $this->hash)->first();
        $this->userId = $userData->id;
        $this->title = "Assign Roles for " . $userData->full_name;
        $userRoleData = $userData->user_role;
        
        return view('livewire.views.user.assign-roles-view', 
        compact('userRoleData') );
    }
}
