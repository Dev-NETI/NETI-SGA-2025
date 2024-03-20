<?php

namespace App\Livewire\Components\User;

use Livewire\Component;

class UserListItemComponent extends Component
{
    public $user;
    
    public function render()
    {
        return view('livewire.components.user.user-list-item-component');
    }
}
