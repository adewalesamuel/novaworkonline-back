<?php

namespace App\Http;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Artisan;
use App\Models\Admin;


class Auth {
    public const ADMIN = "admin";
    public const CLIENT = "client";
    public const ARTISAN = "artisan";

    public static function getUser(Request $request, string $type='client')
    {   
        $token = $request->header('Authorization') ? explode(" ", $request->header('Authorization'))[1] : null;
        $user = null;

        switch ($type) {
            case self::ADMIN:
                $user = self::getAdminByToken($token);
                break;
            case self::ARTISAN:
                $user = self::getArtisanByToken($token);
                break;
            default:
                $user = self::getClientByToken($token);
                break;
        }

        return $user;
    }

    private static function getAdminByToken(string $token) 
    {
        return Admin::where('api_token', $token)->first();
    }

    private static function getClientByToken(string $token)
    {
        return Client::where('api_token', $token)->first();
   
    }

    private static function getArtisanByToken(string $token) 
    {
        return Artisan::where('api_token', $token)->first();
    }
    
}