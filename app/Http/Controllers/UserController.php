<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserTest;
use App\Models\Resume;
use App\Models\InterviewRequest;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Str;
use App\Http\Auth;
use App\Models\Subscription;
use Carbon\Carbon;

class UserController extends Controller
{

    public function analytics(Request $request) {
        $user = Auth::getUser($request, Auth::USER);
        $test = UserTest::where('user_id', $user->id)->first();

        $data = [
            'success' => true,
            'test_score' => $test->score ?? 0
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
            'users' => User::where('id', '>', -1)
            ->orderBy('created_at', 'desc')->paginate()
        ];

        return response()->json($data);
    }

    public function qualified_index(Request $request) {
        $job_title_id = $request->input('job_title_id');

        //get where not in interview-request && not in employee
        $users =  User::where('id', '>', -1)->with(['job_title'])
        ->where('is_active', true)->where('is_qualified', true);

        if ($job_title_id != null)
            $users = $users->where('job_title_id', $job_title_id);

        $users = $users->orderBy('created_at', 'desc')->paginate();
        $data = [
            'success' => true,
            'users' => $users
        ];

        return response()->json($data);
    }

    public function resume_preview(Request $request, $token) {
        $user = User::where('api_token', $token)->first();

        if (!$user) return response("Une erreur est survenue", 200);

        $resume = collect(Resume::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')->first());
        $resume['content'] = json_decode($resume['content']);

        return view('resume', ['resume' => $resume, 'is_recruiter' => false]);
    }

    public function resume(User $user) {
        if (!$user) return response("Une erreur est survenue", 200);

        $resume = collect(Resume::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')->first());
        $resume['content'] = json_decode($resume['content']);

        return view('resume', ['resume' => $resume, 'is_recruiter' => true]);
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
		$user->api_token = Str::random(60);
		$user->country_id = $validated['country_id'] ?? null;
		$user->job_title_id = $validated['job_title_id'] ?? null;

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
        $user['resume'] = $user->resume;
        $user['country'] = $user->country;
        $user['job_title'] = $user->job_title;

        $data = [
            'success' => true,
            'user' => $user
        ];

        return response()->json($data);
    }

    public function recruiter_show(Request $request, User $user)
    {
        $recruiter = Auth::getUser($request, Auth::RECRUITER);

        $subscription = Subscription::where('type', 'recruiter')
        ->where('subscriber_id', $recruiter->id)
        ->orderBy('created_at', 'desc')->firstOrFail();

        if (Carbon::parse($subscription->expiration_date)->lt(Carbon::today()))
            throw new \Exception('Souscription non trouvé ou expirée',1);

        $user['resume'] = $user->resume;
        $user['country'] = $user->country;
        $user['job_title'] = $user->job_title;
        $user['employee'] = $user->employee;
        $user['interview_request'] = InterviewRequest::where('user_id', $user->id)
        ->where('recruiter_id', $recruiter->id)->orderBy('created_at', 'desc')->first();

        $data = [
            'success' => true,
            'user' => $user
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function profile(Request $request)
    {
        $user = Auth::getUser($request, Auth::USER);

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
		$user->birth_date = $validated['birth_date'] ?? null;
		$user->gender = $validated['gender'] ?? null;
		$user->phone_number = $validated['phone_number'] ?? null;
		$user->city = $validated['city'] ?? null;
		$user->profil_img_url = $validated['profil_img_url'] ?? $user->profil_img_url;
		$user->country_id = $validated['country_id'] ?? null;
		$user->job_title_id = $validated['job_title_id'] ?? null;

        if ($validated['password'])
            $user->password = $validated['password'];

        $user->save();

        $data = [
            'success'       => true,
            'user'   => $user
        ];

        return response()->json($data);
    }

    public function update_profile(UpdateUserRequest $request)
    {
        $validated = $request->validated();
        $user = Auth::getUser($request, Auth::USER);

        $user->firstname = $validated['firstname'] ?? null;
		$user->lastname = $validated['lastname'] ?? null;
		$user->email = $validated['email'] ?? null;
		$user->birth_date = $validated['birth_date'] ?? null;
		$user->gender = $validated['gender'] ?? null;
		$user->phone_number = $validated['phone_number'] ?? null;
		$user->city = $validated['city'] ?? null;
		$user->profil_img_url = $validated['profil_img_url'] ?? null;
		$user->country_id = $validated['country_id'] ?? null;
		$user->job_title_id = $validated['job_title_id'] ?? null;

        $user->save();

        $data = [
            'success'       => true,
            'user'   => $user
        ];

        return response()->json($data);
    }

    public function qualify(User $user) {
        $user->is_qualified = true;
        $user->save();

        $data = [
            'success' => true,
        ];

        return response()->json($data, 200);
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
