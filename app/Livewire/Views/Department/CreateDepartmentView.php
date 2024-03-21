<?php

namespace App\Livewire\Views\Department;

use Exception;
use App\Models\Company;
use App\Models\Department;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

class CreateDepartmentView extends Component
{
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
        try {
            $store = Department::create([
                'name' => $this->department,
                'company_id' => $this->company,
            ]);

            if (!$store) {
                session()->flash('error', 'Saving department failed!');
            }
            session()->flash('success', 'Saving department successful!');
            return $this->redirectRoute('department.index');
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function update()
    {
        $this->validate();
        try {
            $departmentData = Department::find($this->departmentId);
            $update = $departmentData->update([
                'name' => $this->department,
                'company_id' => $this->company,
            ]);

            if (!$update) {
                session()->flash('error', 'Updating department failed!');
            }
            session()->flash('success', 'Updating department successful!');
            return $this->redirectRoute('department.index');
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }
}
