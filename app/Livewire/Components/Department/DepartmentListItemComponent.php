<?php

namespace App\Livewire\Components\Department;

use App\Models\Department;
use Exception;
use Livewire\Component;

class DepartmentListItemComponent extends Component
{
    public $department;

    public function render()
    {
        return view('livewire.components.department.department-list-item-component');
    }

    public function destroy($id)
    {
        try {
            
            $departmentData = Department::find($id);
            $destroy = $departmentData->update([
                'is_active' => false,
            ]);

            if (!$destroy) {
                session()->flash('error', 'Deleting department failed!');
            }
            session()->flash('success', 'Deleting department successful!');
            return $this->redirectRoute('department.index');

        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }
}
