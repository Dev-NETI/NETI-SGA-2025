<?php

namespace App\Livewire\Components\User;

use Livewire\Component;

class ListComponent extends Component
{
    public $data;
    public $isRole;
    public $user;

    public function render()
    {
        switch($this->isRole){
            case 1: 
                $tableHeader = "Roles";
                break;
            default:
                $tableHeader = "Curent Role";
                break;
        }
        return view('livewire.components.user.list-component', compact('tableHeader'));
    }
}
