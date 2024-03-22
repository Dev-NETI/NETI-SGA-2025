<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipient extends Model
{
    use HasFactory;
    protected $fillable = ['principal_id', 'name', 'position', 'department', 'is_active', 'modified_by'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $recipient = $model::orderBy('id', 'DESC')->first();
            $hash_id = $recipient != NULL ? encrypt($recipient->id + 1) : encrypt(1);
            $model->hash = $hash_id;
            $model->modified_by = Auth::user()->full_name;
        });

        static::updating(function ($model) {
            $model->modified_by = Auth::user()->full_name;
        });
    }

    // relationships
    public function principal()
    {
        return $this->belongsTo(Principal::class, 'principal_id', 'id');
    }
}
