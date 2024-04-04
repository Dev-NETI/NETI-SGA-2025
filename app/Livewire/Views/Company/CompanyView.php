<?php

namespace App\Livewire\Views\Company;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CompanyView extends Component
{
    use AuthorizesRequests;
    public $title = "Company";

    public function mount()
    {
        Gate::authorize('Authorize', 30);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.views.company.company-view');
    }

    public function create($route)
    {
        return $this->redirectRoute($route);
    }
}
