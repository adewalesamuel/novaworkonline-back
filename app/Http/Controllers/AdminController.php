<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Employee;
use App\Models\Recruiter;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Support\Str;
use App\Http\Auth;


class AdminController extends Controller
{
    public function analytics(Request $request) {
        $user = Auth::getUser($request, Auth::ADMIN);

        $data = [
            'success' => true,
            'user_count' => User::where('is_active', true)->count(),
            'user_qualified_count' => User::where('is_qualified', true)->count(),
            'employee_count' => Employee::count(),
            'recruiter_count' => Recruiter::count()
        ];

        return response()->json($data, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'success' => true,
            'admins' => Admin::where('id', '>', -1)
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
    public function store(StoreAdminRequest $request)
    {
        $validated = $request->validated();

        $admin = new Admin;

        $admin->firstname = $validated['firstname'] ?? null;
		$admin->lastname = $validated['lastname'] ?? null;
		$admin->email = $validated['email'] ?? null;
		$admin->password = $validated['password'] ?? null;
		$admin->phone_number = $validated['phone_number'] ?? null;
		$admin->profil_img_url = $validated['profil_img_url'] ?? null;
		$admin->country_id = $validated['country_id'] ?? null;
		$admin->role_id = $validated['role_id'] ?? null;
        $admin->api_token = Str::random(60);

        $admin->save();

        $data = [
            'success'       => true,
            'admin'   => $admin
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        $data = [
            'success' => true,
            'admin' => $admin
        ];

        return response()->json($data);
    }

    public function profile(Request $request)
    {
        $admin = Auth::getUser($request, Auth::ADMIN);

        $data = [
            'success' => true,
            'admin' => $admin
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        $validated = $request->validated();

        $admin->firstname = $validated['firstname'] ?? null;
		$admin->lastname = $validated['lastname'] ?? null;
		$admin->email = $validated['email'] ?? null;
		$admin->phone_number = $validated['phone_number'] ?? null;
		$admin->profil_img_url = $validated['profil_img_url'] ?? $admin->profil_img_url;
		$admin->country_id = $validated['country_id'] ?? null;
		$admin->role_id = $validated['role_id'] ?? null;

        if ($validated['password'])
            $admin->password = $validated['password'];

        $admin->save();

        $data = [
            'success'       => true,
            'admin'   => $admin
        ];

        return response()->json($data);
    }

    public function update_profile(UpdateAdminRequest $request)
    {
        $validated = $request->validated();
        $admin = Auth::getUser($request, Auth::ADMIN);

        $admin->firstname = $validated['firstname'] ?? null;
		$admin->lastname = $validated['lastname'] ?? null;
		$admin->email = $validated['email'] ?? null;
		$admin->phone_number = $validated['phone_number'] ?? null;
		$admin->profil_img_url = $validated['profil_img_url'] ?? $admin->profil_img_url;
		$admin->country_id = $validated['country_id'] ?? null;
		$admin->role_id = $validated['role_id'] ?? null;

        if ($validated['password'])
            $admin->password = $validated['password'];

        $admin->save();

        $data = [
            'success'       => true,
            'admin'   => $admin
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();

        $data = [
            'success' => true,
            'admin' => $admin
        ];

        return response()->json($data);
    }
}
