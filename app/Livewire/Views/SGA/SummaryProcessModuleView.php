<?php

namespace App\Livewire\Views\SGA;

use App\Models\User;
use App\SummaryTrait;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class SummaryProcessModuleView extends Component
{
    use SummaryTrait;
    public $title = "Summary Process View";
    public $processId;
    public $isGenerated = false;
    public $referenceNumber;
    public $buttonLabel;

    public function mount($processId = false)
    {
        if ($processId) {
            $this->processId = $processId;
        }
        $this->buttonLabel = $this->buttonLabel($this->processId);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.views.s-g-a.summary-process-module-view');
    }

    #[On('generate')]
    public function generate($data)
    {
        $query = User::where('company_id', $data['principal_id'])->where('is_active', 1)->first();
        $recipientId = $query->id;
        Session::put('month', $data['month']);
        Session::put('principalId', $data['principal_id']);
        Session::put('recipientId', $recipientId);
        Session::put('referenceNumber', $data['reference_number']);
        Session::put('generatedUserId', $data['generated_user_id']);
        Session::put('verifiedUserId', $data['verified_user_id']);
        Session::put('approvedUserId', $data['approved_user_id']);
        Session::put('currentProcessId', $this->processId);
        $this->referenceNumber = $data['reference_number'];
        $this->isGenerated = true;
    }

    public function update()
    {
        $this->generateSummary(
            Session::get('month'),
            Session::get('principalId'),
            Session::get('recipientId'),
            false,
            Session::get('referenceNumber'),
            $this->processId,
            Session::get('generatedUserId'),
            Session::get('verifiedUserId'),
            Session::get('approvedUserId')
        );
    }

    public function cancel()
    {
        $this->isGenerated = false;
    }

}
