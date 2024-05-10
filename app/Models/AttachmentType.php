<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachmentType extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'hash', 'is_active'];

    // relationship
    public function fc007_attachment()
    {
        return $this->belongsTo(Fc007Attachment::class, 'attachment_type_id', 'id');
    }

    public function summary_attachment()
    {
        return $this->belongsTo(SummaryAttachment::class, 'attachment_type_id', 'id');
    }
}
