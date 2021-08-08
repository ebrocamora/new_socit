<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\UserReward;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles, LogsActivity;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the user's rewards
     *
     * @return HasMany
     */
    public function reward()
    {
        return $this->hasMany(UserReward::class);
    }

    /**
     * Get the user's referrer
     *
     * @return BelongsTo
     */
    public function referrer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referrer_id', 'id');
    }

    /**
     * Get the user's referred users
     *
     * @return HasMany
     */
    public function referral(): HasMany
    {
        return $this->hasMany(User::class, 'referrer_id', 'id');
    }

    /**
     * Get the activities the user has caused
     * (via Spatie)
     *
     * @return HasMany
     */
    public function activityCaused(): HasMany
    {
        return $this->hasMany(Activity::class, 'causer_id', 'id');
    }

    /**
     * Get the activities the user has been in
     * (via Spatie)
     *
     * @return HasMany
     */
    public function activitySubjected(): HasMany
    {
        return $this->hasMany(Activity::class, 'subject_id', 'id');
    }

    /**
     * Default logs for the model user
     *
     * @return LogOptions
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['username']);
    }
}
