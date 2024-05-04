<?php

namespace App\Livewire\Components\Logs;

use App\Models\AttachmentType;
use App\Models\Fc007Attachment;
use App\Traits\QueryTrait;
use Exception;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Fc007ListItemComponent extends Component
{
    use WithFileUploads;
    use QueryTrait;
    public $data;
    #[Validate([
        'attachmentType' => 'required',
        'description' => 'required|min:2|max:200',
        'file' => 'required',
    ])]
    public $attachmentType;
    public $description;
    public $file;
    public $statusId;
    public $attachmentData;
    public $search;


    public function render()
    {
        $query = AttachmentType::where('is_active', 1);
        switch ($this->statusId) {
            case (2 || 3):
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
        return view('livewire.components.logs.fc007-list-item-component', compact('attachmentTypeData'));
    }

    public function show()
    {
        $this->dispatch('generate', data: $this->data);
    }

    public function storeAttachment()
    {
        $this->validate();

        // save to folder
        $filename = $this->file->hashName();
        $save = $this->saveFileToStorage('public/F-FC-007-Attachments', $filename);

        if (!$save) {
            session()->flash('error', 'Failed to save attachment to storage');
        }

        //save to database
        $query = Fc007Attachment::create([
            'fc_log_id' => $this->data->id,
            'attachment_type_id' => $this->attachmentType,
            'description' => $this->description,
            'filepath' => $filename,
        ]);
        $store = $this->storeTrait($query, "Saving attachment failed!", "Saving attachment success!");
        if (!$store) {
            session()->flash('error', 'Saving attachment failed!');
        }
        session()->flash('success', 'Saving attachment success!');
        return $this->redirectRoute('sga.process-fc007', ['processId' => $this->statusId]);
    }

    public function showAttachment($id)
    {
        $attachmentData = Fc007Attachment::where('fc_log_id', $id)->where('is_active', 1)->get();
        if ($attachmentData !== NULL) {
            $this->attachmentData = $attachmentData;
        }
    }
}
