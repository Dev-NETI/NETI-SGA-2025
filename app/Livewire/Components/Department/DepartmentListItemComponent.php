<?php

namespace App\Livewire\Components\Department;

use Exception;
use Livewire\Component;
use App\Models\Department;
use App\Traits\QueryTrait;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DepartmentListItemComponent extends Component
{
    use AuthorizesRequests;
    use QueryTrait;
    public $department;

    public function render()
    {
        return view('livewire.components.department.department-list-item-component');
    }

    public function destroy($id)
    {
        Gate::authorize('Authorize', 37);
        $data = Department::find($id);
        $query = $data->update([
            'is_active' => false,
        ]);
        $routeBack = "department.index";
        $errorMsg = "Deleting department failed!";
        $successMsg = "Deleting department successful!";

        $this->updateTrait($data, $routeBack, $query, $errorMsg, $successMsg);
        return $this->redirectRoute($routeBack);
    }
}
