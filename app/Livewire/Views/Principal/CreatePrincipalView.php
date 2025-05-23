<?php

namespace App\Livewire\Views\Principal;

use Livewire\Component;
use App\Models\Principal;
use App\Traits\QueryTrait;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CreatePrincipalView extends Component
{
    use AuthorizesRequests;
    use QueryTrait;
    public $hash;

    #[Validate([
        'principal' => 'required|min:2',
        'address' => 'required|min:5',
    ])]
    public $principal;
    public $principalId;
    public $address;

    public function mount($hash_id = null)
    {
        if ($hash_id != null) {
            $this->hash = $hash_id;
            $principalData = Principal::where('hash', $this->hash)->first();
            $this->principal = $principalData->name;
            $this->principalId = $principalData->id;
            $this->address = $principalData->address;
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.views.principal.create-principal-view');
    }

    public function store()
    {
        Gate::authorize('Authorize', 16);
        $this->validate();
        $query = Principal::create([
            'name' => $this->principal,
            'address' => $this->address,
        ]);
        $errorMsg = "Saving principal failed!";
        $successMsg = "Saving principal successful!";
        $route = "principal.index";

        $this->storeTrait($query, $errorMsg, $successMsg);
        return $this->redirectRoute($route);
    }

    public function update()
    {
        Gate::authorize('Authorize', 17);
        $this->validate();
        $data = Principal::find($this->principalId);
        $query = $data->update([
            'name' => $this->principal,
            'address' => $this->address,
        ]);
        $routeBack = "principal.index";
        $errorMsg = "Updating principal failed!";
        $successMsg = "Updating principal successful!";

        $this->updateTrait($data, $routeBack, $query, $errorMsg, $successMsg);
        return $this->redirectRoute($routeBack);
    }
}
