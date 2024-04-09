<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SummaryLog extends Model
{
    use HasFactory;
    protected $fillable = ['reference_number','file_path','modified_by','hash'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $summary = $model::orderBy('id', 'DESC')->first();
            $hash_id = $summary != NULL ? encrypt($summary->id + 1) : encrypt(1);
            $model->hash = $hash_id;
            $model->modified_by = Auth::user()->full_name;
        });

        static::updating(function ($model) {
            $model->modified_by = Auth::user()->full_name;
        });
    }
    
}
