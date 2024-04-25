<?php

namespace App\Livewire\Views\SGA;

use App\EmailManagementTrait;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class Fc007ProcessModuleView extends Component
{
    use EmailManagementTrait;
    public $title;
    public $processId;
    public $isGenerated = 0;
    public $referenceNumber;

    public function mount($processId)
    {
        $this->processId = $processId;
        $this->title = $this->pageTitle($processId);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.views.s-g-a.fc007-process-module-view');
    }

    #[On('generate')]
    public function generate($data)
    {
        $this->referenceNumber = $data['referenceNumber'];
        $this->isGenerated = $data['isGenerated'];
        // $this->isGenerated = $isGenerated;
    }
}
