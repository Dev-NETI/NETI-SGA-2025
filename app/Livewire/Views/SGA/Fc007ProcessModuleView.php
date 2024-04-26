<?php

namespace App\Livewire\Views\SGA;

use App\EmailManagementTrait;
use App\StoredReportTrait;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class Fc007ProcessModuleView extends Component
{
    use EmailManagementTrait;
    use StoredReportTrait;
    public $title;
    public $processId;
    public $isGenerated = 0;
    public $referenceNumber;
    public $fcLogId;

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
        Session::put('logId', $data['id']);
        Session::put('referenceNumber', $data['reference_number']);
        $this->referenceNumber = $data['reference_number'];
        $this->isGenerated = 1;
        $this->fcLogId = $data['id'];
    }

    public function cancel()
    {
        Session::forget(['logId', 'referenceNumber']);
        $this->reset(['isGenerated','fcLogId','referenceNumber']);
    }

    public function update()
    {
        $this->generateFC007($this->fcLogId, $this->referenceNumber, false,$this->processId);
    }

}
