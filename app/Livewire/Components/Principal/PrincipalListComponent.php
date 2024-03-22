<?php

namespace App\Livewire\Components\Principal;

use App\Models\Principal;
use Livewire\Component;
use Livewire\WithPagination;

class PrincipalListComponent extends Component
{
    use WithPagination;
    public $search;

    public function render()
    {
        $principalData = Principal::where('is_active', true)
        ->where('name','LIKE','%'.$this->search.'%')
        ->orderBy('name','asc')
        ->paginate(5);

        return view('livewire.components.principal.principal-list-component', compact('principalData'));
    }
}
