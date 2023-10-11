<?php

namespace App\Http;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Recruiter;
use App\Models\Admin;


class Auth {
    public const ADMIN = "admin";
    public const USER = "user";
    public const RECRUITER = "recruiter";

    public static function getUser(Request $request, string $type='user')
    {
        $token = $request->header('Authorization') ?
        explode(" ", $request->header('Authorization'))[1] : null;
        $user = null;

        switch ($type) {
            case self::ADMIN:
                $user = self::getAdminByToken($token);
                break;
            case self::RECRUITER:
                $user = self::getArtisanByToken($token);
                break;
            default:
                $user = self::getUserByToken($token);
                break;
        }

        return $user;
    }

    private static function getAdminByToken(string $token)
    {
        return Admin::where('api_token', $token)->first();
    }

    private static function getUserByToken(string $token)
    {
        return User::where('api_token', $token)->first();

    }

    private static function getArtisanByToken(string $token)
    {
        return Recruiter::where('api_token', $token)->first();
    }

}
