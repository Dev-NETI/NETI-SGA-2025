<?php

namespace App\Livewire\Views\Recipient;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RecipientView extends Component
{
    use AuthorizesRequests;
    public $title = "Recipient";

    public function mount()
    {
        Gate::authorize('Authorize', 19);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.views.recipient.recipient-view');
    }

    public function create($route)
    {
        return $this->redirectRoute($route);
    }
}
