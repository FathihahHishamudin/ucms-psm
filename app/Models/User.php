<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Model\PC_Chair;

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
        'First_name',
        'Last_name',
        'Salutation',
        'Association',
        'email',
        'password',
    ];

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function pcchair(){
        return $this->hasMany(PC_Chair::class);
    }

    public function nparticipant(): HasMany
    {
        return $this->hasMany(Normal_Participant::class, 'User_id');
    }

    public function authors(): HasMany
    {
        return $this->hasMany(Author::class, 'User_id');
    }

    public function cochair(): HasMany
    {
        return $this->hasMany(PC_CoChair::class, 'User_id');
    }

    public function assgcochair(): HasMany
    {
        return $this->hasMany(assignCochair::class, 'User_id');
    }

    public function reviewer(): HasMany
    {
        return $this->hasMany(Reviewer::class, 'User_id');
    }

    public function assgreviewer(): HasMany
    {
        return $this->hasMany(assignReviewer::class, 'User_id');
    }
}
