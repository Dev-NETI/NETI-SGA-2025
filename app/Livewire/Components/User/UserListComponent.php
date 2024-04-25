<?php

namespace App\Livewire\Components\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserListComponent extends Component
{
    use WithPagination;
    public $search;

    public function render()
    {
        $userData = User::where('is_active', true)
        ->where('f_name','LIKE','%'.$this->search.'%')
        ->orWhere('m_name','LIKE','%'.$this->search.'%')
        ->orWhere('l_name','LIKE','%'.$this->search.'%')
        ->orWhere('email','LIKE','%'.$this->search.'%')
        ->orderBy('f_name','asc')
        ->paginate(5);

        return view('livewire.components.user.user-list-component', compact('userData'));
    }
}
