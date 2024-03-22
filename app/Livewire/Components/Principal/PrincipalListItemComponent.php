<?php

namespace App\Livewire\Components\Principal;

use Livewire\Component;

class PrincipalListItemComponent extends Component
{
    public $principal;
    public function render()
    {
        return view('livewire.components.principal.principal-list-item-component');
    }
}
