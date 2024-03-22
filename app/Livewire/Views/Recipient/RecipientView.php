<?php

namespace App\Livewire\Views\Recipient;

use Livewire\Attributes\Layout;
use Livewire\Component;

class RecipientView extends Component
{
    public $title = "Recipient";

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.views.recipient.recipient-view');
    }

    public function create($route)
    {
        return $this->redirectRoute($route);
    }
    
}
