<?php

namespace App\Livewire\Components\Reusable;

use Livewire\Component;

class Td extends Component
{
    public $label;
    
    public function render()
    {
        return view('livewire.components.reusable.td');
    }
}
