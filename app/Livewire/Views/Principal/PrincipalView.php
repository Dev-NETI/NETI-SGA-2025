<?php

namespace App\Livewire\Views\Principal;

use Livewire\Attributes\Layout;
use Livewire\Component;

class PrincipalView extends Component
{
    public $title = "Principal";

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.views.principal.principal-view');
    }

    public function create($route)
    {
        return $this->redirectRoute($route);
    }
}
