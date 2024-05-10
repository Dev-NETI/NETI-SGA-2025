<?php

namespace App\Livewire\Views\SGA;

use App\Models\SummaryLog;
use App\Models\User;
use App\SummaryTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SummaryProcessModuleView extends Component
{
    use SummaryTrait;
    public $title = "Summary Process View";
    public $processId;
    public $isGenerated = false;
    public $referenceNumber;
    public $buttonLabel;
    public $summaryLogId;
    #[Validate([
        'sendBackDetails' => 'required|min:5|max:200',
    ])]
    public $sendBackDetails;

    public function mount($processId = false)
    {
        $this->authorization($processId);
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
        $this->summaryLogId = $data["id"];
        $this->referenceNumber = $data['reference_number'];
        $this->isGenerated = true;
    }

    public function update()
    {
        $this->authorization($this->processId);
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

    public function updateSendBack()
    {
        $this->validate();
        $data = SummaryLog::find($this->summaryLogId);
        $query = $data->update([
            'status_id' => 1,
            'send_back_details' => $this->sendBackDetails,
            'send_back_at' => now(),
            'send_back_by' => Auth::user()->full_name,
        ]);
        $this->updateTrait($data, 'sga.process-summary', $query, "Sending back failed!", 'Sending back success!');
        return $this->redirectRoute('sga.process-summary', ['processId' => $this->processId]);
    }
}
