<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Passwords\CanResetPassword;
use App\Notifications\ResetPasswordNotification;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, CanResetPassword;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'api_token'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = Hash::make($value);
    }
	public function country()
	{
		return $this->belongsTo(Country::class);
	}
	public function job_title()
	{
		return $this->belongsTo(JobTitle::class);
	}
	public function resume()
	{
		return $this->hasOne(Resume::class);
	}
	public function interview_request()
	{
		return $this->hasOne(InterViewRequest::class);
	}
	public function employee()
	{
		return $this->hasOne(Employee::class);
	}
    /**
     * Send a password reset notification to the user.
     *
     * @param  string  $token
    */
    public function sendPasswordResetNotification($token): void
    {
        $url = env('APP_USER_URL')."/nouveau-motdepasse?token=".$token;

        $this->notify(new ResetPasswordNotification($url));
    }

}
