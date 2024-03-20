<?php

namespace App\Livewire\Views\Company;

use App\Models\Company;
use Exception;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateCompanyView extends Component
{
    public $hash = null;

    #[Validate([
        'name' => 'required|min:2',
        'code' => 'required|min:2',
    ])]
    public $name;
    public $code;
    public $companyId;

    #[Layout('layouts.app')]
    public function mount($hash_id = null)
    {
        if($hash_id != NULL){
            $this->hash = $hash_id;
            $companyData = Company::where('hash', $this->hash)
            ->first();
            $this->name = $companyData->name;
            $this->code = $companyData->code;
            $this->companyId = $companyData->id;
        }
    }

    public function render()
    {
        return view('livewire.views.company.create-company-view');
    }

    public function store()
    {
        $this->validate();
        try {
            $store = Company::create([
                'name' => $this->name,
                'code' => $this->code
            ]);

            if(!$store){
                session()->flash('error', 'Saving company failed!');
            }
            session()->flash('success', 'Company saved successfully!');
            return $this->redirectRoute('company.index');
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function update()
    {
        $this->validate();
        try {
            $companyData = Company::find($this->companyId);
            $update = $companyData->update([
                'name' => $this->name,
                'code' => $this->code
            ]);

            if(!$update){
                session()->flash('error', 'Updating company failed!');
            }
            session()->flash('success', 'Company updated successfully!');
            return $this->redirectRoute('company.index');
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }
}
