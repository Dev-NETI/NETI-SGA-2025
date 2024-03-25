<?php

namespace App\Livewire\Components\SGA;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Session;

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
        Session::put('month', $this->month);
        return $this->redirectRoute('generate.letter');
    }
}
