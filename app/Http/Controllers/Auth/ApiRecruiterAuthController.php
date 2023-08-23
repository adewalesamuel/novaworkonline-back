<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreArtisanRequest;

class ApiArtisanAuthController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only("email", "password");
    
        if (!Auth::guard('artisans')->once($credentials)) {
            $data = [
                'error' => true,
                'message' => "Mail ou mot de passe incorrect"
            ];

            return response()->json($data, 404);
        }

        $artisan = Artisan::where('email', $credentials['email'])->first();

        $data = [
            "success" => true,
            "artisan" => $artisan,
            'tk' => $artisan->api_token,
        ];

        return response()->json($data);
    }

    public function register(StoreArtisanRequest $request)
    {
        $validated = $request->validated();

        $artisan = new Artisan;

        $artisan->name = $validated['name'] ?? null;
		$artisan->email = $validated['email'] ?? null;
		$artisan->password = $validated['password'] ?? null;
		$artisan->phone = $validated['phone'] ?? null;
		$artisan->country = $validated['country'] ?? null;
		$artisan->city = $validated['city'] ?? null;
		$artisan->postal_code = $validated['postal_code'] ?? null;
		$artisan->address = $validated['address'] ?? null;
		$artisan->is_active = $validated['is_active'] ?? null;
		$artisan->img_url = $validated['img_url'] ?? null;
        $artisan->api_token = Str::random(60);
		
        $artisan->save();

        $data = [
            'success'       => true,
            'artisan'   => $artisan,
        ];
        
        return response()->json($data);
    }

    public function logout(Request $request) {
        $token = explode(" ", $request->header('Authorization'))[1];
        $artisan = Artisan::where('api_token', $token)->first();

        if (!$artisan) {
            $data = [
                "error" => true,
                "message" => "Une erreure est survenue"
            ];

            return response()->json($data, 500);
        }

        $artisan->api_token = Str::random(60);

        $artisan->save();

        $data = [
            "success" => true,
        ];

        return response()->json($data, 200);
    }
    
}
