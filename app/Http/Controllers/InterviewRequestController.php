<?php
namespace App\Http\Controllers;

use App\Models\InterviewRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreInterviewRequestRequest;
use App\Http\Requests\UpdateInterviewRequestRequest;
use Illuminate\Support\Str;
use App\Http\Auth;
use App\Jobs\AdminMailNotificationJob;
use App\Jobs\MailNotificationJob;
use App\Models\Subscription;
use App\Notifications\InterviewRequestNotification;
use App\Notifications\InterviewRequestUserNotification;
use Carbon\Carbon;

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
            'interview_requests' => InterviewRequest::with(['user', 'recruiter'])
            ->where('id', '>', -1)->orderBy('created_at', 'desc')->paginate()
        ];

        return response()->json($data);
    }

    public function recruiter_index(Request $request)
    {
        $recruiter = Auth::getUser($request, Auth::RECRUITER);

        $data = [
            'success' => true,
            'interview_requests' => InterviewRequest::with(['user'])
            ->where('id', '>', -1)->where('recruiter_id', $recruiter->id)
            ->where('status', 'pending')
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
    public function store(StoreInterviewRequestRequest $request)
    {
        $validated = $request->validated();

        $interview_request = new InterviewRequest;

		$interview_request->recruiter_id = $validated['recruiter_id'] ?? null;
		$interview_request->user_id = $validated['user_id'] ?? null;
		$interview_request->description = $validated['description'] ?? null;

        $interview_request->save();

        $data = [
            'success'       => true,
            'interview_request'   => $interview_request
        ];

        return response()->json($data);
    }

    public function recruiter_store(StoreInterviewRequestRequest $request)
    {
        $validated = $request->validated();
        $recruiter = Auth::getUser($request, Auth::RECRUITER);
        $subscription = Subscription::where('type', 'recruiter')
        ->where('subscriber_id', $recruiter->id)
        ->orderBy('created_at', 'desc')->first();

        if (!$subscription)
            throw new \Exception('Vous n\'avez pas de souscription',1);

        //return josn response with message
        if (Carbon::parse($subscription->expiration_date)->lt(Carbon::today()))
            throw new \Exception('Votre souscription à expirée',1);

        //return josn response with message
        if (Carbon::parse($subscription->expiration_date)->lt(Carbon::today()))
            throw new \Exception('Votre souscription à expirée',1);

        $interview_request = new InterviewRequest;

		$interview_request->recruiter_id = $recruiter->id;
		$interview_request->user_id = $validated['user_id'] ?? null;
		$interview_request->description = $validated['description'] ?? null;

        $interview_request->save();

        AdminMailNotificationJob::dispatchAfterResponse(
            new InterviewRequestNotification($interview_request));
        MailNotificationJob::dispatchAfterResponse(
            User::findOrFail($validated['user_id']),
            new InterviewRequestUserNotification($interview_request)
        );

        $data = [
            'success'       => true,
            'interview_request'   => $interview_request
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InterviewRequest  $interview_request
     * @return \Illuminate\Http\Response
     */
    public function show(InterviewRequest $interview_request)
    {
        $interview_request['user'] = User::with(['job_title'])
        ->find($interview_request->user_id);
        $interview_request['recruiter'] = $interview_request->recruiter;

        $data = [
            'success' => true,
            'interview_request' => $interview_request
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InterviewRequest  $interview_request
     * @return \Illuminate\Http\Response
     */
    public function edit(InterviewRequest $interview_request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InterviewRequest  $interview_request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInterviewRequestRequest $request,
    InterviewRequest $interview_request)
    {
        $validated = $request->validated();

        $interview_request->status = $validated['status'] ?? null;
		$interview_request->recruiter_id = $validated['recruiter_id'] ?? null;
		$interview_request->user_id = $validated['user_id'] ?? null;
		$interview_request->description = $validated['description'] ?? null;
		$interview_request->recruiter_id = $validated['recruiter_id'] ?? null;

        $interview_request->save();

        $data = [
            'success'       => true,
            'interview_request'   => $interview_request
        ];

        return response()->json($data);
    }

    public function reject(Request $request, InterviewRequest $interview_request) {
        $interview_request->status = 'rejected';
        $interview_request->description = $request->input('description');

        $interview_request->save();

        $data = [
            'sucess' => true,
            'interview_request' => $interview_request
        ];

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InterviewRequest  $interview_request
     * @return \Illuminate\Http\Response
     */
    public function destroy(InterviewRequest $interview_request)
    {
        $interview_request->delete();

        $data = [
            'success' => true,
            'interview_request' => $interview_request
        ];

        return response()->json($data);
    }
}
