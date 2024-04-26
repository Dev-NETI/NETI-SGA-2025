<?php

namespace App\Livewire\Components\Logs;

use Livewire\Component;

class Fc007ListItemComponent extends Component
{
    public $data;

    public function render()
    {
        return view('livewire.components.logs.fc007-list-item-component');
    }

    public function show()
    {
        $this->dispatch('generate', data: $this->data);
    }
}
