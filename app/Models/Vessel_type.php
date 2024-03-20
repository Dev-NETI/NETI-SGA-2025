<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vessel_type extends Model
{
    use HasFactory;
    protected $fillable = ['name','is_active','hash'];

    // relationships
    public function vessel()
    {
        return $this->hasMany(Vessel::class, 'vessel_type_id', 'id');
    }

    // mutator
    public function setHashAttribute($value)
    {
        $vesselType = self::orderBy('id','DESC')->first();
        $hash_id = $vesselType != NULL ? encrypt($vesselType->id + 1) : encrypt(1);
        $this->attributes['hash'] = $hash_id;
    }
}
