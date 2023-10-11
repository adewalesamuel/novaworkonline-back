<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recruiter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreRecruiterRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class ApiRecruiterAuthController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only("email", "password");

        if (!Auth::guard('recruiter')->once($credentials)) {
            $data = [
                'error' => true,
                'message' => "Mail ou mot de passe incorrect"
            ];

            return response()->json($data, 404);
        }

        $recruiter = Recruiter::where('email', $credentials['email'])->first();

        $data = [
            "success" => true,
            "recruiter" => $recruiter,
            'tk' => $recruiter->api_token,
        ];

        return response()->json($data);
    }

    public function register(StoreRecruiterRequest $request)
    {
        $validated = $request->validated();

        $recruiter = new Recruiter;
        $token =  Str::random(60);

        $recruiter->firstname = $validated['firstname'] ?? null;
		$recruiter->lastname = $validated['lastname'] ?? null;
		$recruiter->email = $validated['email'] ?? null;
		$recruiter->password = $validated['password'] ?? null;
		$recruiter->company_name = $validated['company_name'] ?? null;
		$recruiter->location = $validated['location'] ?? null;
		$recruiter->is_active = true;
        $recruiter->api_token = $token;

        $recruiter->save();

        $data = [
            'success'       => true,
            'recruiter'   => $recruiter,
            'tk' => $token
        ];

        return response()->json($data);
    }

    public function forgot_password(ForgotPasswordRequest $request) {
        $validated = $request->validated();
        $status = Password::broker('recruiters')->sendResetLink($validated);

        $data = [
            'status' => __($status)
        ];

        return response()->json($data, 200);
    }

    public function reset_password(ResetPasswordRequest $request) {
        $validated = $request->validated();

        $status = Password::broker('recruiters')->reset(
            $validated,
            function (Recruiter $recruiter, string $password) {
                $recruiter->password = $password;
                $recruiter->save();

                event(new PasswordReset($recruiter));
            }
        );

        $data = [
            'status' => __($status)
        ];

        return response()->json($data, 200);
    }

    public function logout(Request $request) {
        $token = explode(" ", $request->header('Authorization'))[1];
        $recruiter = Recruiter::where('api_token', $token)->first();

        if (!$recruiter) {
            $data = [
                "error" => true,
                "message" => "Une erreur est survenue"
            ];

            return response()->json($data, 500);
        }

        $recruiter->api_token = Str::random(60);

        $recruiter->save();

        $data = [
            "success" => true,
        ];

        return response()->json($data, 200);
    }

}
