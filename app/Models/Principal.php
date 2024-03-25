<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Principal extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'is_active', 'modified_by', 'address'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $principal = $model::orderBy('id', 'DESC')->first();
            $hash_id = $principal != NULL ? encrypt($principal->id + 1) : encrypt(1);
            $model->hash = $hash_id;
            $model->modified_by = Auth::user()->full_name;
        });

        static::updating(function ($model) {
            $model->modified_by = Auth::user()->full_name;
        });
    }

    // relationships
    public function recipient()
    {
        return $this->hasMany(Recipient::class, 'principal_id','id');
    }

    public function vessel()
    {
        return $this->hasMany(Vessel::class,'principal_id','id');
    }
}
