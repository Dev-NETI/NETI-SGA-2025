<?php

namespace App\Livewire\Views\Department;

use Exception;
use App\Models\Company;
use App\Models\Department;
use App\Traits\QueryTrait;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

class CreateDepartmentView extends Component
{
    use QueryTrait;
    public $hash;

    #[Validate([
        'department' => 'required|min:2',
        'company' => 'required'
    ])]
    public $department;
    public $company;
    public $departmentId;

    public function mount($hash_id = null)
    {
        if ($hash_id != null) {
            $this->hash = $hash_id;
            $departmentData = Department::where('hash', $this->hash)->first();
            $this->department = $departmentData->name;
            $this->company = $departmentData->company_id;
            $this->departmentId = $departmentData->id;
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $companyData = Company::where('is_active', true)
            ->orderBy('name', 'asc')
            ->paginate(5);

        return view('livewire.views.department.create-department-view', compact('companyData'));
    }

    public function store()
    {
        $this->validate();
        $query = Department::create([
            'name' => $this->department,
            'company_id' => $this->company,
        ]);
        $errorMsg = "Saving department failed!";
        $successMsg = "Saving department successful!";
        $route = "department.index";

        $this->storeTrait($query, $errorMsg, $successMsg);
        return $this->redirectRoute($route);
    }

    public function update()
    {
        $this->validate();
        $data = Department::find($this->departmentId);
        $query = $data->update([
            'name' => $this->department,
            'company_id' => $this->company,
        ]);
        $routeBack = "department.index";
        $errorMsg = "Updating deparment failed!";
        $successMsg = "Updating deparment successful!";

        $this->updateTrait($data,$routeBack,$query, $errorMsg, $successMsg);
        return $this->redirectRoute($routeBack);
    }
}
