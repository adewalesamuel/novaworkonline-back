<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Str;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'success' => true,
            'users' => User::where('id', '>', -1)
            ->orderBy('created_at', 'desc')->get()
        ];

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $user = new User;

        $user->firstname = $validated['firstname'] ?? null;
		$user->lastname = $validated['lastname'] ?? null;
		$user->email = $validated['email'] ?? null;
		$user->password = $validated['password'] ?? null;
		$user->birth_date = $validated['birth_date'] ?? null;
		$user->gender = $validated['gender'] ?? null;
		$user->phone_number = $validated['phone_number'] ?? null;
		$user->city = $validated['city'] ?? null;
		$user->profil_img_url = $validated['profil_img_url'] ?? null;
		$user->api_token = $validated['api_token'] ?? null;
		$user->is_active = $validated['is_active'] ?? null;
		$user->is_qualified = $validated['is_qualified'] ?? null;
		$user->country_id = $validated['country_id'] ?? null;
		$user->jobtitle_id = $validated['jobtitle_id'] ?? null;
		
        $user->save();

        $data = [
            'success'       => true,
            'user'   => $user
        ];
        
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $data = [
            'success' => true,
            'user' => $user
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();

        $user->firstname = $validated['firstname'] ?? null;
		$user->lastname = $validated['lastname'] ?? null;
		$user->email = $validated['email'] ?? null;
		$user->password = $validated['password'] ?? null;
		$user->birth_date = $validated['birth_date'] ?? null;
		$user->gender = $validated['gender'] ?? null;
		$user->phone_number = $validated['phone_number'] ?? null;
		$user->city = $validated['city'] ?? null;
		$user->profil_img_url = $validated['profil_img_url'] ?? null;
		$user->api_token = $validated['api_token'] ?? null;
		$user->is_active = $validated['is_active'] ?? null;
		$user->is_qualified = $validated['is_qualified'] ?? null;
		$user->country_id = $validated['country_id'] ?? null;
		$user->jobtitle_id = $validated['jobtitle_id'] ?? null;
		
        $user->save();

        $data = [
            'success'       => true,
            'user'   => $user
        ];
        
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {   
        $user->delete();

        $data = [
            'success' => true,
            'user' => $user
        ];

        return response()->json($data);
    }
}