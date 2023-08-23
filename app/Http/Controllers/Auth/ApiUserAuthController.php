<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreClientRequest;

class ApiClientAuthController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only("email", "password");
    
        if (!Auth::guard('clients')->once($credentials)) {
            $data = [
                'error' => true,
                'message' => "Mail ou mot de passe incorrect"
            ];

            return response()->json($data, 404);
        }

        $client = Client::where('email', $credentials['email'])->first();

        $data = [
            "success" => true,
            "client" => $client,
            "tk" => $client->api_token
        ];

        return response()->json($data);
    }

    public function register(StoreClientRequest $request) {
        $validated = $request->validated();

        $client = new Client;

        $client->name = $validated['name'] ?? null;
		$client->email = $validated['email'] ?? null;
		$client->password = $validated['password'] ?? null;
		$client->phone = $validated['phone'] ?? null;
		$client->country = $validated['country'] ?? null;
		$client->city = $validated['city'] ?? null;
		$client->address = $validated['address'] ?? null;
		$client->is_active = $validated['is_active'] ?? null;
		$client->img_url = $validated['img_url'] ?? null;
        $client->api_token = Str::random(60);
		
        $client->save();

        $data = [
            'success'  => true,
            'client'   => $client
        ];
        
        return response()->json($data);
    }

    public function logout(Request $request) {
        $token = explode(" ", $request->header('Authorization'))[1];
        $client = Client::where('api_token', $token)->first();

        if (!$client) {
            $data = [
                "error" => true,
                "message" => "Une erreure est survenue"
            ];

            return response()->json($data, 500);
        }

        $client->api_token = Str::random(60);

        $client->save();

        $data = [
            "success" => true,
        ];

        return response()->json($data, 200);
    }
    
}
