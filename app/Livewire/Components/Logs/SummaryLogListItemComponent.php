<?php

namespace App\Livewire\Components\Logs;

use App\Models\AttachmentType;
use App\Models\SummaryAttachment;
use Livewire\Component;
use App\Models\SummaryLog;
use App\Traits\QueryTrait;
use Illuminate\Support\Facades\Redirect;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;

class SummaryLogListItemComponent extends Component
{
    use WithFileUploads;
    use QueryTrait;
    public $summary;
    public $statusId;
    #[Validate([
        'attachmentType' => 'required',
        'description' => 'required|min:2|max:200',
        'file' => 'required',
    ])]
    public $attachmentType;
    public $description;
    public $file;
    public $attachmentData;

    public function render()
    {
        $query = AttachmentType::where('is_active', 1);
        switch ($this->statusId) {
            case 2:
                $attachmentTypeData = $query->where('id', 3)->get();
                break;
            case 3:
                $attachmentTypeData = $query->where('id', 3)->get();
                break;
            case 4:
                $attachmentTypeData = $query->where('id', 1)->get();
                break;
            case 5:
                $attachmentTypeData = $query->where('id', 2)->get();
                break;
            default:
                $attachmentTypeData = null;
                break;
        }
        return view('livewire.components.logs.summary-log-list-item-component', compact('attachmentTypeData'));
    }

    public function show()
    {
        $this->dispatch('generate', data: $this->summary);
    }

    public function storeAttachment()
    {
        $this->validate();

        // save to folder
        $filename = $this->file->hashName();
        $save = $this->saveFileToStorage('public/Summary-Attachments', $filename);

        if (!$save) {
            session()->flash('error', 'Failed to save attachment to storage');
        }

        //save to database
        $query = SummaryAttachment::create([
            'summary_log_id' => $this->summary->id,
            'attachment_type_id' => $this->attachmentType,
            'description' => $this->description,
            'filepath' => $filename,
        ]);
        $store = $this->storeTrait($query, "Saving attachment failed!", "Saving attachment success!");
        if (!$store) {
            session()->flash('error', 'Saving attachment failed!');
        }
        session()->flash('success', 'Saving attachment success!');
        return $this->redirectRoute('sga.process-summary', ['processId' => $this->statusId]);
    }

    public function showAttachment($id)
    {
        $attachmentData = SummaryAttachment::where('summary_log_id', $id)->where('is_active', 1)->get();
        if ($attachmentData !== NULL) {
            $this->attachmentData = $attachmentData;
        }
    }
}
