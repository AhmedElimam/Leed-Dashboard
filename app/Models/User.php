<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relationships
     */

    // Example: A user can have many reports
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    // Example: A user can have many jobs
    public function jobs()
    {
        return $this->belongsToMany(Job::class);
    }

    // Example: A user can have failed jobs (if you use a custom relationship)
    public function failedJobs()
    {
        return $this->hasMany(FailedJob::class);
    }

    /**
     * Scopes
     */

    // Example scope: Active users
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Accessors and Mutators
     */

    // Example accessor: Full name
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // Example mutator: Hash password before saving
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
