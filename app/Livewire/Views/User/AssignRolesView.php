<?php

namespace App\Livewire\Views\User;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use App\Models\UserRole;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AssignRolesView extends Component
{
    use AuthorizesRequests;
    public $title;
    public $hash;
    public $userId;

    public function mount($hash_id = null)
    {
        Gate::authorize('Authorize', 28);
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

        return view(
            'livewire.views.user.assign-roles-view',
            compact('userRoleData')
        );
    }
}
