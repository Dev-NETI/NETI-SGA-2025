<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'f_name',
        'm_name',
        'l_name',
        'password',
        'company_id',
        'department_id',
        'is_active',
        'position_id',
        'signature_path',
        'is_principal'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = $model::orderBy('id', 'DESC')->first();
            $hash_id = $user != NULL ? encrypt($user->id + 1) : encrypt(1);
            $model->hash = $hash_id;
            $model->modified_by = Auth::user()->full_name;
        });

        static::updating(function ($model) {
            $model->modified_by = Auth::user()->full_name;
        });
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // relationship
    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }

    public function user_role()
    {
        return $this->hasMany(UserRole::class, 'user_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function summary_email_recipient()
    {
        return $this->hasMany(SummaryReportEmailRecipient::class, 'user_id', 'id');
    }

    public function fc_email_recipient()
    {
        return $this->hasMany(Fc007ReportEmailRecipient::class, 'user_id', 'id');
    }

    // acessor
    public function getFullNameAttribute()
    {
        return $this->f_name . " " . $this->m_name . " " . $this->l_name;
    }

    public function getNameAttribute()
    {
        return $this->f_name . " " . $this->m_name . " " . $this->l_name." / ".$this->position->name;
    }

    public function getPrincipalAttribute()
    {
        return $this->is_principal === 1 ? 'Yes':'No';
    }
}
