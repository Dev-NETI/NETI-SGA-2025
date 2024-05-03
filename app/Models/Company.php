<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Company extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'code', 'modified_by','is_active','address'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $company = $model::orderBy('id', 'DESC')->first();
            $hash_id = $company != NULL ? encrypt($company->id + 1) : encrypt(1);
            $model->hash = $hash_id;
            $model->modified_by = Auth::user()->full_name;
        });

        static::updating(function ($model) {
            $model->modified_by = Auth::user()->full_name;
        });
    }

    // relationship
    public function department()
    {
        return $this->hasMany(Department::class, 'company_id', 'id');
    }

    public function user()
    {
        return $this->hasMany(User::class, 'company_id', 'id');
    }
}
