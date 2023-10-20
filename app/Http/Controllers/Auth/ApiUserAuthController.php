<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Jobs\AdminMailNotificationJob;
use App\Notifications\UserRegisterNotification;

class ApiUserAuthController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only("email", "password");

        if (!Auth::guard()->once($credentials)) {
            $data = [
                'error' => true,
                'message' => "Mail ou mot de passe incorrect"
            ];

            return response()->json($data, 404);
        }

        $user = User::where('email', $credentials['email'])->first();

        $data = [
            "success" => true,
            "user" => $user,
            "tk" => $user->api_token
        ];

        return response()->json($data);
    }

    public function register(StoreUserRequest $request) {
        $validated = $request->validated();

        $user = new User;
        $token =  Str::random(60);

        $user->firstname = $validated['firstname'] ?? null;
		$user->lastname = $validated['lastname'] ?? null;
		$user->email = $validated['email'] ?? null;
		$user->password = $validated['password'] ?? null;
        $user->api_token = $token;

        $user->save();

        AdminMailNotificationJob::dispatchAfterResponse(
            new UserRegisterNotification($user));

        $data = [
            'success'  => true,
            'user'   => $user,
            'tk' => $token
        ];

        return response()->json($data);
    }

    public function forgot_password(ForgotPasswordRequest $request) {
        $validated = $request->validated();
        $status = Password::sendResetLink($validated);

        $data = [
            'status' => __($status)
        ];

        return response()->json($data, 200);
    }

    public function reset_password(ResetPasswordRequest $request) {
        $validated = $request->validated();

        $status = Password::reset(
            $validated,
            function (User $user, string $password) {
                $user->password = $password;
                $user->save();

                event(new PasswordReset($user));
            }
        );

        $data = [
            'status' => __($status)
        ];

        return response()->json($data, 200);
    }

    public function logout(Request $request) {
        $token = explode(" ", $request->header('Authorization'))[1];
        $user = User::where('api_token', $token)->first();

        if (!$user) {
            $data = [
                "error" => true,
                "message" => "Une erreur est survenue"
            ];

            return response()->json($data, 500);
        }

        $user->api_token = Str::random(60);

        $user->save();

        $data = [
            "success" => true,
        ];

        return response()->json($data, 200);
    }

}
