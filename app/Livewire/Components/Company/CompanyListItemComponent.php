<?php

namespace App\Livewire\Components\Company;

use App\Models\Company;
use Exception;
use Livewire\Component;

class CompanyListItemComponent extends Component
{
    public $company;

    public function render()
    {
        return view('livewire.components.company.company-list-item-component');
    }

    public function destroy($id)
    {
        try {
            $companyData = Company::find($id);
            $destroy = $companyData->update([
                'is_active' => false,
            ]);
            if(!$destroy){
                session()->flash('error', 'Deleting company failed!');
            }

            session()->flash('success', 'Deleting company successful!');
            return $this->redirectRoute('company.index');
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }
}
