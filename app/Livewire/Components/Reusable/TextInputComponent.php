<?php

namespace App\Livewire\Components\Reusable;

use Livewire\Attributes\Validate;
use Livewire\Component;

class TextInputComponent extends Component
{
    public $model;

    public $label;

    public function render()
    {
        return view('livewire.components.reusable.text-input-component');
    }
}
