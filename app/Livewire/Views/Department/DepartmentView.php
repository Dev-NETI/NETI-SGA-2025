<?php

namespace App\Livewire\Views\Department;

use Livewire\Attributes\Layout;
use Livewire\Component;

class DepartmentView extends Component
{
    public $title = "Department";

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.views.department.department-view');
    }
}
