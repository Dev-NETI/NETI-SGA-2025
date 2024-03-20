<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Vessel extends Model
{
    use HasFactory;
    protected $fillable = ['vessel_type_id','hash','name','code','training_fee','modified_by','is_active'];

    // relationships
    public function vessel_type()
    {
        return $this->belongsTo(Vessel_type::class, 'vessel_type_id', 'id');
    }

    // mutator
    public function setHashAttribute($value)
    {
        $vessel = self::orderBy('id','DESC')->first();
        $hash_id = $vessel != NULL ? encrypt($vessel->id + 1) : encrypt(1);
        $this->attributes['hash'] = $hash_id;
    }

    public function setModifiedByAttribute($value)
    {
        $this->attributes['modified_by'] = Auth::user()->name;
    }

    // acessor

    public function getFormattedUpdatedDateAttribute()
    {
        return Carbon::parse($this->updated_at)->format('F d, Y');
    }
}
