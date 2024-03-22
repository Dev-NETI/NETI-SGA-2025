<?php

namespace App\Livewire\Views\Recipient;

use App\Models\Principal;
use App\Models\Recipient;
use App\Traits\QueryTrait;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateRecipientView extends Component
{
    use QueryTrait;
    public $hash;

    #[Validate([
        'name' => 'required|min:2',
        'principal' => 'required',
        'department' => 'required|min:2',
        'position' => 'required|min:2',
    ])]
    public $name;
    public $principal;
    public $department;
    public $position;
    public $recipientId;

    public function mount($hash_id = null)
    {
        if ($hash_id != null) {
            $this->hash = $hash_id;
            $recipientData = Recipient::where('hash', $this->hash)->first();
            $this->name = $recipientData->name;
            $this->principal = $recipientData->principal_id;
            $this->department = $recipientData->department;
            $this->position = $recipientData->position;
            $this->recipientId = $recipientData->id;
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $principalData = Principal::where('is_active', true)
            ->orderBy('name', 'asc')
            ->get();

        return view('livewire.views.recipient.create-recipient-view', compact('principalData'));
    }

    public function store()
    {
        $this->validate();
        $query = Recipient::create([
            'principal_id' => $this->principal,
            'name' => $this->name,
            'position' => $this->position,
            'department' => $this->department,
        ]);
        $errorMsg = "Saving recipient failed!";
        $successMsg = "Saving recipient successful!";
        $route = "recipient.index";

        $this->storeTrait($query, $errorMsg, $successMsg);
        return $this->redirectRoute($route);
    }

    public function update()
    {
        $this->validate();

        $data = Recipient::find($this->recipientId);
        $query = $data->update([
            'principal_id' => $this->principal,
            'name' => $this->name,
            'position' => $this->position,
            'department' => $this->department,
        ]);

        $routeBack = "recipient.index";
        $errorMsg = "Updating recipient failed!";
        $successMsg = "Updating recipient successful!";

        $this->updateTrait($data, $routeBack, $query, $errorMsg, $successMsg);
        return $this->redirectRoute($routeBack);
    }
}
