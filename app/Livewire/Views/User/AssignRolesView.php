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
        if($hash_id != NULL){
            $this->hash = $hash_id;
            $userData = User::where('hash',$this->hash)->first();
            $this->userId = $userData->id;
            $this->title = "Assign Roles for ".$userData->full_name;
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $roleData = Role::where('is_active', true)->orderBy('name','asc')->get();
        $userRoleData = UserRole::whereHas('user', function($query){
                                $query->where('hash', $this->hash);
                        })
                        ->get();
                        
        return view('livewire.views.user.assign-roles-view', compact('roleData','userRoleData'));
    }
}
