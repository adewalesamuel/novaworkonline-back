<?php
namespace App\Http\Controllers;

use App\Http\Auth;
use App\Models\JobTitle;
use Illuminate\Http\Request;
use App\Http\Requests\StoreJobTitleRequest;
use App\Http\Requests\UpdateJobTitleRequest;
use Illuminate\Support\Str;


class JobTitleController extends Controller
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
            'job_titles' => JobTitle::where('id', '>', -1)
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
    public function store(StoreJobTitleRequest $request)
    {
        $validated = $request->validated();

        $job_title = new JobTitle;

        $job_title->name = $validated['name'] ?? null;
		$job_title->slug = Str::slug($validated['name']);
		$job_title->description = $validated['description'] ?? null;
		$job_title->icon_url = $validated['icon_url'] ?? null;

        $job_title->save();

        $data = [
            'success'       => true,
            'job_title'   => $job_title
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobTitle  $job_title
     * @return \Illuminate\Http\Response
     */
    public function show(JobTitle $job_title)
    {
        $data = [
            'success' => true,
            'job_title' => $job_title
        ];

        return response()->json($data);
    }

    public function user_show(Request $request) {
        $user = Auth::getUser($request, Auth::USER);

        $data = [
            'success' => true,
            'job_title' => $user->job_title
        ];

        return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobTitle  $job_title
     * @return \Illuminate\Http\Response
     */
    public function edit(JobTitle $job_title)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobTitle  $job_title
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJobTitleRequest $request, JobTitle $job_title)
    {
        $validated = $request->validated();

        $job_title->name = $validated['name'] ?? null;
		$job_title->slug = Str::slug($validated['name']);
		$job_title->description = $validated['description'] ?? null;
		$job_title->icon_url = $validated['icon_url'] ?? null;

        $job_title->save();

        $data = [
            'success'       => true,
            'job_title'   => $job_title
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobTitle  $job_title
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobTitle $job_title)
    {
        $job_title->delete();

        $data = [
            'success' => true,
            'job_title' => $job_title
        ];

        return response()->json($data);
    }
}
