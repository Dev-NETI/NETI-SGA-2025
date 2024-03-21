<?php

namespace App\Livewire\Components\Department;

use App\Models\Department;
use Livewire\Component;
use Livewire\WithPagination;

class DepartmentListComponent extends Component
{
    use WithPagination;
    public $search;

    public function render()
    {
        $departmentData = Department::where('is_active', true)
                        ->where('name','LIKE','%'.$this->search.'%')
                        ->orderBy('name')
                        ->paginate(5);
                        
        return view('livewire.components.department.department-list-component', compact('departmentData'));
    }
}
