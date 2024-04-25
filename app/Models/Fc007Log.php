<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Fc007Log extends Model
{
    use HasFactory;
    protected $fillable = ['reference_number', 'file_path', 'modified_by', 'hash','status_id'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $fc007 = $model::orderBy('id', 'DESC')->first();
            $hash_id = $fc007 != NULL ? encrypt($fc007->id + 1) : encrypt(1);
            $model->hash = $hash_id;
            $model->modified_by = Auth::user()->full_name;
        });

        static::updating(function ($model) {
            $model->modified_by = Auth::user()->full_name;
        });
    }
}
