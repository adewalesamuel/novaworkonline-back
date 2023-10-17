<?php
namespace App\Http\Controllers;

use App\Models\Recruiter;
use App\Models\User;
use App\Models\Employee;
use App\Models\Project;
use App\Models\InterviewRequest;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRecruiterRequest;
use App\Http\Requests\UpdateRecruiterRequest;
use Illuminate\Support\Str;
use App\Http\Auth;


class RecruiterController extends Controller
{

    public function analytics(Request $request) {
        $recruiter = Auth::getUser($request, Auth::RECRUITER);

        $data = [
            'success' => true,
            'qualified_user_count' => User::where('is_qualified', true)->count(),
            'interview_request_count' => InterviewRequest::where('status', '!=', 'rejected')
            ->where('recruiter_id', $recruiter->id)->count(),
            'employees_count' => Employee::where('recruiter_id', $recruiter->id)->count(),
            'projects_count' => Project::where('recruiter_id', $recruiter->id)->count()
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
            'recruiters' => Recruiter::where('id', '>', -1)
            ->orderBy('created_at', 'desc')->paginate()
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
    public function store(StoreRecruiterRequest $request)
    {
        $validated = $request->validated();

        $recruiter = new Recruiter;

        $recruiter->firstname = $validated['firstname'] ?? null;
		$recruiter->lastname = $validated['lastname'] ?? null;
		$recruiter->email = $validated['email'] ?? null;
		$recruiter->password = $validated['password'] ?? null;
		$recruiter->birth_date = $validated['birth_date'] ?? null;
		$recruiter->gender = $validated['gender'] ?? null;
		$recruiter->phone_number = $validated['phone_number'] ?? null;
		$recruiter->location = $validated['location'] ?? null;
		$recruiter->company_name = $validated['company_name'] ?? null;
		$recruiter->company_info = $validated['company_info'] ?? null;
		$recruiter->country_id = $validated['country_id'] ?? null;
        $recruiter->profil_img_url = $validated['profil_img_url'] ?? null;
        $recruiter->api_token = Str::random(60);

        $recruiter->save();

        $data = [
            'success'       => true,
            'recruiter'   => $recruiter
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recruiter  $recruiter
     * @return \Illuminate\Http\Response
     */
    public function show(Recruiter $recruiter)
    {
        $data = [
            'success' => true,
            'recruiter' => $recruiter
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recruiter  $recruiter
     * @return \Illuminate\Http\Response
     */
    public function profile(Request $request)
    {
        $recruiter = Auth::getUser($request, Auth::RECRUITER);

        $data = [
            'success' => true,
            'recruiter' => $recruiter
        ];

        return response()->json($data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recruiter  $recruiter
     * @return \Illuminate\Http\Response
     */
    public function edit(Recruiter $recruiter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recruiter  $recruiter
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRecruiterRequest $request, Recruiter $recruiter)
    {
        $validated = $request->validated();

        $recruiter->firstname = $validated['firstname'] ?? null;
		$recruiter->lastname = $validated['lastname'] ?? null;
		$recruiter->email = $validated['email'] ?? null;
		$recruiter->birth_date = $validated['birth_date'] ?? null;
		$recruiter->gender = $validated['gender'] ?? null;
		$recruiter->phone_number = $validated['phone_number'] ?? null;
		$recruiter->location = $validated['location'] ?? null;
		$recruiter->company_name = $validated['company_name'] ?? null;
		$recruiter->company_info = $validated['company_info'] ?? null;
		$recruiter->country_id = $validated['country_id'] ?? null;
		$recruiter->profil_img_url = $validated['profil_img_url'] ?? $recruiter->profil_img_url;

        if ($validated['password'])
            $recruiter->password = $validated['password'];

        $recruiter->save();

        $data = [
            'success'       => true,
            'recruiter'   => $recruiter
        ];

        return response()->json($data);
    }

    public function update_profile(UpdateRecruiterRequest $request)
    {
        $validated = $request->validated();
        $recruiter = Auth::getUser($request, Auth::RECRUITER);

        $recruiter->firstname = $validated['firstname'] ?? null;
		$recruiter->lastname = $validated['lastname'] ?? null;
		$recruiter->email = $validated['email'] ?? null;
		$recruiter->birth_date = $validated['birth_date'] ?? null;
		$recruiter->gender = $validated['gender'] ?? null;
		$recruiter->phone_number = $validated['phone_number'] ?? null;
		$recruiter->location = $validated['location'] ?? null;
		$recruiter->company_name = $validated['company_name'] ?? null;
		$recruiter->company_info = $validated['company_info'] ?? null;
		$recruiter->country_id = $validated['country_id'] ?? null;

        if ($validated['profil_img_url'])
		    $recruiter->profil_img_url = $validated['profil_img_url'] ?? null;

        $recruiter->save();

        $data = [
            'success'       => true,
            'recruiter'   => $recruiter
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recruiter  $recruiter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recruiter $recruiter)
    {
        $recruiter->delete();

        $data = [
            'success' => true,
            'recruiter' => $recruiter
        ];

        return response()->json($data);
    }
}
