<?php

namespace App\Livewire\Views\Company;

use App\Models\Company;
use App\Traits\QueryTrait;
use Exception;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateCompanyView extends Component
{
    use QueryTrait;
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
        $query = Company::create([
            'name' => $this->name,
            'code' => $this->code
        ]);
        $errorMsg = "Saving company failed!";
        $successMsg = "Saving company successful!";
        $route = "company.index";

        $this->storeTrait($query, $errorMsg, $successMsg);
        return $this->redirectRoute($route);
    }

    public function update()
    {
        $this->validate();
        $data = Company::find($this->companyId);
        $query = $data->update([
            'name' => $this->name,
            'code' => $this->code
        ]);
        $routeBack = "company.index";
        $errorMsg = "Updating company failed!";
        $successMsg = "Updating company successful!";

        $this->updateTrait($data,$routeBack,$query, $errorMsg, $successMsg);
        return $this->redirectRoute($routeBack);
    }
}
