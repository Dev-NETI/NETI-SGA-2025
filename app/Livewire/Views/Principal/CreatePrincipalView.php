<?php

namespace App\Livewire\Views\Principal;

use App\Models\Principal;
use App\Traits\QueryTrait;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreatePrincipalView extends Component
{
    use QueryTrait;
    public $hash;

    #[Validate([
        'principal' => 'required|min:2',
    ])]
    public $principal;
    public $principalId;

    public function mount($hash_id = null)
    {
        if ($hash_id != null) {
            $this->hash = $hash_id;
            $principalData = Principal::where('hash', $this->hash)->first();
            $this->principal = $principalData->name;
            $this->principalId = $principalData->id;
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.views.principal.create-principal-view');
    }

    public function store()
    {
        $this->validate();
        $query = Principal::create([
            'name' => $this->principal,
        ]);
        $errorMsg = "Principal saved!";
        $successMsg = "Saving principal failed!";
        $route = "principal.index";

        $this->store($query, $errorMsg, $successMsg);
        return $this->redirectRoute($route);
    }

    // public function update()
    // {
    //     $this->validate();
    //     $data = Principal::find($this->principalId);
    //     $query = $data->update([
    //         'name' => $this->principal,
    //     ]);
    //     $routeBack = "principal.index";
    //     $errorMsg = "Principal updated!";
    //     $successMsg = "Updating principal failed!";
    //     $route = "principal.index";

    //     $this->update($data,$routeBack,$query, $errorMsg, $successMsg, $route);
    // }

}
