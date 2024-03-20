<?php

namespace App\Livewire\Views\User;

use Livewire\Attributes\Layout;
use Livewire\Component;

class UserView extends Component
{
    public $title = 'User Management';

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.views.user.user-view');
    }

    public function create()
    {
        return $this->redirectRoute('users.create', navigate:true);
    }
}
