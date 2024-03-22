<?php

namespace App\Livewire\Components\Company;

use App\Models\Company;
use App\Traits\QueryTrait;
use Exception;
use Livewire\Component;

class CompanyListItemComponent extends Component
{
    use QueryTrait;
    public $company;

    public function render()
    {
        return view('livewire.components.company.company-list-item-component');
    }

    public function destroy($id)
    {
        $data = Company::find($id);
        $query = $data->update([
            'is_active' => false,
        ]);
        $routeBack = "company.index";
        $errorMsg = "Deleting company failed!";
        $successMsg = "Deleting company successful!";

        $this->updateTrait($data, $routeBack, $query, $errorMsg, $successMsg);
        return $this->redirectRoute($routeBack);
    }
}
