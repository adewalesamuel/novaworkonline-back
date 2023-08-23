<?php
namespace App\Http\Controllers;

use App\Models\Recruiter;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRecruiterRequest;
use App\Http\Requests\UpdateRecruiterRequest;
use Illuminate\Support\Str;


class RecruiterController extends Controller
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
            'recruiters' => Recruiter::where('id', '>', -1)
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
		$recruiter->profil_img_url = $validated['profil_img_url'] ?? null;
		$recruiter->company_name = $validated['company_name'] ?? null;
		$recruiter->company_info = $validated['company_info'] ?? null;
		$recruiter->api_token = $validated['api_token'] ?? null;
		$recruiter->is_active = $validated['is_active'] ?? null;
		$recruiter->country_id = $validated['country_id'] ?? null;
		
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
		$recruiter->password = $validated['password'] ?? null;
		$recruiter->birth_date = $validated['birth_date'] ?? null;
		$recruiter->gender = $validated['gender'] ?? null;
		$recruiter->phone_number = $validated['phone_number'] ?? null;
		$recruiter->location = $validated['location'] ?? null;
		$recruiter->profil_img_url = $validated['profil_img_url'] ?? null;
		$recruiter->company_name = $validated['company_name'] ?? null;
		$recruiter->company_info = $validated['company_info'] ?? null;
		$recruiter->api_token = $validated['api_token'] ?? null;
		$recruiter->is_active = $validated['is_active'] ?? null;
		$recruiter->country_id = $validated['country_id'] ?? null;
		
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