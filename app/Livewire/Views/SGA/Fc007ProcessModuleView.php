<?php

namespace App\Livewire\Views\SGA;

use App\EmailManagementTrait;
use App\Models\Fc007Attachment;
use App\Models\Fc007Log;
use App\StoredReportTrait;
use App\Traits\QueryTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Fc007ProcessModuleView extends Component
{
    use QueryTrait;
    use EmailManagementTrait;
    use StoredReportTrait;
    use WithFileUploads;
    public $title;
    public $processId;
    public $isGenerated = 0;
    public $referenceNumber;
    public $fcLogId;
    public $principalId;
    public $buttonLabel;
    #[Validate([
        'sendBackDetails' => 'required|min:5|max:200',
    ])]
    public $sendBackDetails;
    public $description;
    public $file;

    public function mount($processId)
    {
        $this->processId = $processId;
        $this->title = $this->pageTitle($processId);
        $this->buttonLabel = $this->buttonLabel($processId);
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
        Session::put('processId', $this->processId);
        $this->referenceNumber = $data['reference_number'];
        $this->isGenerated = 1;
        $this->fcLogId = $data['id'];
        $this->principalId = $data['principal_id'];
    }

    public function cancel()
    {
        Session::forget(['logId', 'referenceNumber']);
        $this->reset(['isGenerated', 'fcLogId', 'referenceNumber']);
    }

    public function update()
    {
        $this->generateFC007($this->fcLogId, $this->referenceNumber, false, $this->processId, $this->principalId);
    }

    public function updateSendBack()
    {
        $this->validate();
        $data = Fc007Log::find($this->fcLogId);
        $query = $data->update([
            'status_id' => 1,
            'send_back_details' => $this->sendBackDetails,
            'send_back_at' => now(),
            'send_back_by' => Auth::user()->full_name,
        ]);
        $this->updateTrait($data, 'sga.process-fc007', $query, "Sending back failed!", 'Sending back success!');
        return $this->redirectRoute('sga.process-fc007', ['processId' => $this->processId]);
    }

    public function storeAttachment()
    {
        $this->validate([
            'file' => 'required',
            'description' => 'required'
        ]);
        $attachmentTypeId = $this->attachmentTypeId($this->processId);
        // save to folder
        $filename = $this->file->hashName();
        $save = $this->saveFileToStorage('public/F-FC-007-Attachments',$filename);

        if(!$save){
            session()->flash('error', 'Failed to save attachment to storage');
        }

        //save to database
        $query = Fc007Attachment::create([
            'fc_log_id' => $this->fcLogId,
            'attachment_type_id' => $attachmentTypeId,
            'description' => $this->description,
            'filepath' => $filename,
        ]);
        $store = $this->storeTrait($query, "", "");
        if(!$store){
            session()->flash('error', 'Saving attachment failed!');
        }

        //update status
        $this->update();
    }

}
