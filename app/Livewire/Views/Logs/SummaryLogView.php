<?php

namespace App\Livewire\Views\Logs;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\Attributes\Layout;

class SummaryLogView extends Component
{
    use AuthorizesRequests;
    public $title = "Summary Logs";
    
    public function mount()
    {
        Gate::authorize('Authorize', 39);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.views.logs.summary-log-view');
    }
}
