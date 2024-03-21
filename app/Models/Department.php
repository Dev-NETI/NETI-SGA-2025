<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Department extends Model
{
    use HasFactory;
    protected $fillable = ['name','company_id','modified_by','is_active'];

    public static function boot()
    {
        parent::boot();
        static::creating(function($model){
            $department = $model::orderBy('id', 'DESC')->first();
            $hash_id = $department != NULL ? encrypt($department->id + 1) : encrypt(1);
            $model->hash = $hash_id;
            $model->modified_by = Auth::user()->full_name;
        });

        static::updating(function($model){
            $model->modified_by = Auth::user()->full_name;
        });
    }

    // relationship
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function user()
    {
        return $this->hasMany(User::class, 'department_id', 'id');
    }
}
