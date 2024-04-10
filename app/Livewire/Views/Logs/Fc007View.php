<?php

namespace App\Livewire\Views\Logs;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Layout;

class Fc007View extends Component
{
    use AuthorizesRequests;
    public $title = "F-FC-007 Logs";

    public function mount()
    {
        Gate::authorize('Authorize', 40);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.views.logs.fc007-view');
    }
}
