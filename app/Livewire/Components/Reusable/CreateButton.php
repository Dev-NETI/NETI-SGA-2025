<?php

namespace App\Livewire\Components\Reusable;

use Livewire\Component;

class CreateButton extends Component
{
    public $label;
    public $routeName;

    public function render()
    {
        return view('livewire.components.reusable.create-button');
    }

    
}
