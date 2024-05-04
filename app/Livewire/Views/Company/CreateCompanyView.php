<?php

namespace App\Livewire\Views\Company;

use Exception;
use App\Models\Company;
use Livewire\Component;
use App\Traits\QueryTrait;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CreateCompanyView extends Component
{
    use AuthorizesRequests;
    use QueryTrait;
    public $hash = null;

    #[Validate([
        'name' => 'required|min:2',
        'code' => 'required|min:2',
        'principal' => 'required'
    ])]
    public $name;
    public $code;
    public $companyId;
    public $address;
    public $principal;
    public $principalData;

    #[Layout('layouts.app')]
    public function mount($hash_id = null)
    {
        $this->principalData =  [
            (object)['id' => 0, 'name' => 'No'],
            (object)['id' => 1, 'name' => 'Yes']
        ];

        if ($hash_id != NULL) {
            $this->hash = $hash_id;
            $companyData = Company::where('hash', $this->hash)
                ->first();
            $this->name = $companyData->name;
            $this->code = $companyData->code;
            $this->companyId = $companyData->id;
            $this->principal = $companyData->is_principal;
            $this->address = $companyData->address;
        }
    }

    public function render()
    {
        return view('livewire.views.company.create-company-view');
    }

    public function store()
    {
        Gate::authorize('Authorize', 31);
        $this->validate();
        $query = Company::create([
            'name' => $this->name,
            'code' => $this->code,
            'address' => $this->address,
            'is_principal' => $this->principal
        ]);
        $errorMsg = "Saving company failed!";
        $successMsg = "Saving company successful!";
        $route = "company.index";

        $this->storeTrait($query, $errorMsg, $successMsg);
        return $this->redirectRoute($route);
    }

    public function update()
    {
        Gate::authorize('Authorize', 32);
        $this->validate();
        $data = Company::find($this->companyId);
        $query = $data->update([
            'name' => $this->name,
            'code' => $this->code,
            'address' => $this->address,
            'is_principal' => $this->principal
        ]);
        $routeBack = "company.index";
        $errorMsg = "Updating company failed!";
        $successMsg = "Updating company successful!";

        $this->updateTrait($data, $routeBack, $query, $errorMsg, $successMsg);
        return $this->redirectRoute($routeBack);
    }
}
