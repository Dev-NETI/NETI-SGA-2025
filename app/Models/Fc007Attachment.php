<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Fc007Attachment extends Model
{
    use HasFactory;
    protected $fillable = ['fc_log_id','attachment_type_id','description','filepath'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $attachment = $model::orderBy('id', 'DESC')->first();
            $hash_id = $attachment != NULL ? encrypt($attachment->id + 1) : encrypt(1);
            $model->hash = $hash_id;
            $model->modified_by = Auth::user()->full_name;
        });

        static::updating(function ($model) {
            $model->modified_by = Auth::user()->full_name;
        });
    }

    // relationship
    public function attachment_type()
    {
        return $this->belongsTo(AttachmentType::class,'attachment_type_id','id');
    }
}
