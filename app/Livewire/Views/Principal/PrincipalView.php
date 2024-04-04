<?php

namespace App\Livewire\Views\Principal;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PrincipalView extends Component
{
    use AuthorizesRequests;
    public $title = "Principal";

    public function mount()
    {
        Gate::authorize('Authorize', 15);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.views.principal.principal-view');
    }

    public function create($route)
    {
        return $this->redirectRoute($route);
    }
}
