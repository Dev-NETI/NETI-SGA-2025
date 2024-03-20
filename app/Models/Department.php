<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    // relationship
    public function company()
    {
        return $this->belongsTo(Company::class, 'department_id', 'id');
    }

    public function user()
    {
        return $this->hasMany(User::class, 'department_id', 'id');
    }
}
