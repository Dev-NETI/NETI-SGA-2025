<?php

namespace App\Livewire\Views\Department;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DepartmentView extends Component
{
    use AuthorizesRequests;
    public $title = "Department";

    public function mount()
    {
        Gate::authorize('Authorize', 34);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.views.department.department-view');
    }

    public function create($route)
    {
        return $this->redirectRoute($route);
    }
}
