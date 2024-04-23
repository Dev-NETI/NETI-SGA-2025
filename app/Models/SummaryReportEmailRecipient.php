<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SummaryReportEmailRecipient extends Model
{
    use HasFactory;
    protected $fillable = ['process_id','user_id','is_active'];

    protected static function boot()
    {
            parent::boot();
            
            static::creating(function ($model){
                $model->modified_by = Auth::user()->full_name;
            });
            static::updating(function ($model){
                $model->modified_by = Auth::user()->full_name;
            });
    }

    // relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
