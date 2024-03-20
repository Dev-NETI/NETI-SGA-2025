<?php

namespace App\Livewire\Components\Reusable;

use Livewire\Component;

class ErrorSpanRed extends Component
{
    public $message;
    
    public function render()
    {
        return view('livewire.components.reusable.error-span-red');
    }
}
