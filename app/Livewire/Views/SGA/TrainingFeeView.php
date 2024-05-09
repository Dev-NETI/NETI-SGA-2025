<?php

namespace App\Livewire\Views\SGA;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Gate;

class TrainingFeeView extends Component
{
    use AuthorizesRequests;
    public $title = "Reports Module";
    public $contentTitle = "Generate FC-007";

    public function mount()
    {
        Gate::authorize('Authorize', 41);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.views.s-g-a.training-fee-view');
    }
}
