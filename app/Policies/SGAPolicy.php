<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class SGAPolicy
{
    public function Authorize(User $user , $roleId)
    {
        return $user->user_role->pluck('role_id')->contains($roleId) ? 
        Response::allow()
        :
        Response::deny('You don\'t have access right to this module! Please contact system administrator.');
    }
}
