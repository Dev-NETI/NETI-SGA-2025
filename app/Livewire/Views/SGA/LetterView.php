<?php

namespace App\Livewire\Views\SGA;

use Livewire\Component;
use Livewire\Attributes\Layout;

class LetterView extends Component
{
    public $title="SGA";
    public $contentTitle="Letter for Principal";

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.views.s-g-a.letter-view');
    }
}
