<?php

namespace App\Livewire\Components\SGA;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class GenerateLetterComponent extends Component
{
    #[Validate([
        'month' => 'required',
    ])]
    public $month;

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.components.s-g-a.generate-letter-component');
    }

    public function generate()
    {
        $this->validate();
    }
}
