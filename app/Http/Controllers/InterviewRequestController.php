<?php
namespace App\Http\Controllers;

use App\Models\InterviewRequest;
use Illuminate\Http\Request;
use App\Http\Requests\StoreInterviewRequestRequest;
use App\Http\Requests\UpdateInterviewRequestRequest;
use Illuminate\Support\Str;


class InterviewRequestController extends Controller
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
            'interviewrequests' => InterviewRequest::where('id', '>', -1)
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
    public function store(StoreInterviewRequestRequest $request)
    {
        $validated = $request->validated();

        $interviewrequest = new InterviewRequest;

        $interviewrequest->status = $validated['status'] ?? null;
		$interviewrequest->recruteur_id = $validated['recruteur_id'] ?? null;
		$interviewrequest->user_id = $validated['user_id'] ?? null;
		$interviewrequest->slug = $validated['slug'] ?? null;
		$interviewrequest->description = $validated['description'] ?? null;
		$interviewrequest->recruiter_id = $validated['recruiter_id'] ?? null;
		
        $interviewrequest->save();

        $data = [
            'success'       => true,
            'interviewrequest'   => $interviewrequest
        ];
        
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InterviewRequest  $interviewrequest
     * @return \Illuminate\Http\Response
     */
    public function show(InterviewRequest $interviewrequest)
    {
        $data = [
            'success' => true,
            'interviewrequest' => $interviewrequest
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InterviewRequest  $interviewrequest
     * @return \Illuminate\Http\Response
     */
    public function edit(InterviewRequest $interviewrequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InterviewRequest  $interviewrequest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInterviewRequestRequest $request, InterviewRequest $interviewrequest)
    {
        $validated = $request->validated();

        $interviewrequest->status = $validated['status'] ?? null;
		$interviewrequest->recruteur_id = $validated['recruteur_id'] ?? null;
		$interviewrequest->user_id = $validated['user_id'] ?? null;
		$interviewrequest->slug = $validated['slug'] ?? null;
		$interviewrequest->description = $validated['description'] ?? null;
		$interviewrequest->recruiter_id = $validated['recruiter_id'] ?? null;
		
        $interviewrequest->save();

        $data = [
            'success'       => true,
            'interviewrequest'   => $interviewrequest
        ];
        
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InterviewRequest  $interviewrequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(InterviewRequest $interviewrequest)
    {   
        $interviewrequest->delete();

        $data = [
            'success' => true,
            'interviewrequest' => $interviewrequest
        ];

        return response()->json($data);
    }
}