<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Passwords\CanResetPassword;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Facades\Password;

class Recruiter extends Authenticatable
{
    use HasApiTokens, HasFactory, SoftDeletes, Notifiable, CanResetPassword;

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

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Send a password reset notification to the user.
     *
     * @param  string  $token
    */
    public function sendPasswordResetNotification($token): void
    {
        $url = env('APP_RECRUITER_URL')."/nouveau-motdepasse?token=".$token;

        $this->notify(new ResetPasswordNotification($url));
    }

	public function country()
	{
		return $this->belongsTo(Country::class);
	}
}
