<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Vessel extends Model
{
    use HasFactory;
    protected $fillable = ['vessel_type_id','hash','name','code','training_fee','modified_by','is_active','principal_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $vessel = $model::orderBy('id', 'DESC')->first();
            $hash_id = $vessel != NULL ? encrypt($vessel->id + 1) : encrypt(1);
            $model->hash = $hash_id;
            $model->modified_by = Auth::user()->full_name;
        });

        static::updating(function ($model) {
            $model->modified_by = Auth::user()->full_name;
        });
    }

    // relationships
    public function vessel_type()
    {
        return $this->belongsTo(Vessel_type::class, 'vessel_type_id', 'id');
    }

    public function principal()
    {
        return $this->belongsTo(Principal::class,'principal_id','id');
    }

    // mutator

    // acessor

    public function getFormattedUpdatedDateAttribute()
    {
        return Carbon::parse($this->updated_at)->format('F d, Y');
    }
}
