<?php

namespace App\Livewire\Components\Recipient;

use Livewire\Component;
use App\Models\Recipient;
use Livewire\WithPagination;

class RecipientListComponent extends Component
{
    use WithPagination;
    public $search;

    public function render()
    {
        $recipientData = Recipient::where('is_active', true)
                        ->where('name','LIKE','%'.$this->search.'%')
                        ->orderBy('name')
                        ->paginate(5);

        return view('livewire.components.recipient.recipient-list-component', compact('recipientData'));
    }
}
