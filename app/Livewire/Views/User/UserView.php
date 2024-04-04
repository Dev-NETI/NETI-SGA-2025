<?php

namespace App\Livewire\Views\User;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserView extends Component
{
    use AuthorizesRequests;
    public $title = 'User Management';

    public function mount()
    {
        Gate::authorize('Authorize', 24);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.views.user.user-view');
    }

    public function create($route)
    {
        return $this->redirectRoute($route);
    }
}
