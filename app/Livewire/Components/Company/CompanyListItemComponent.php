<?php

namespace App\Livewire\Components\Company;

use Exception;
use App\Models\Company;
use Livewire\Component;
use App\Traits\QueryTrait;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CompanyListItemComponent extends Component
{
    use AuthorizesRequests;
    use QueryTrait;
    public $company;

    public function render()
    {
        return view('livewire.components.company.company-list-item-component');
    }

    public function destroy($id)
    {
        Gate::authorize('Authorize', 33);
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
