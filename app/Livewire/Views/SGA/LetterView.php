<?php

namespace App\Livewire\Views\SGA;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\Attributes\Layout;

class LetterView extends Component
{
    use AuthorizesRequests;
    public $title = "SGA";
    public $contentTitle = "Summary";

    public function mount()
    {
        Gate::authorize('Authorize', 2);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.views.s-g-a.letter-view');
    }
}
