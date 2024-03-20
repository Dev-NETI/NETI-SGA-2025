<?php

namespace App\Livewire\Components\Reusable;

use Livewire\Component;

class SubmitButton extends Component
{
    public $label;

    public function render()
    {
        return view('livewire.components.reusable.submit-button');
    }
}
