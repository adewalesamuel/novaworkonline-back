<?php
namespace App\Http\Controllers;

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

        $jobtitle = new JobTitle;

        $jobtitle->name = $validated['name'] ?? null;
		$jobtitle->slug = Str::slug($validated['name']);
		$jobtitle->description = $validated['description'] ?? null;
		$jobtitle->icon_url = $validated['icon_url'] ?? null;

        $jobtitle->save();

        $data = [
            'success'       => true,
            'jobtitle'   => $jobtitle
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobTitle  $jobtitle
     * @return \Illuminate\Http\Response
     */
    public function show(JobTitle $jobtitle)
    {
        $data = [
            'success' => true,
            'jobtitle' => $jobtitle
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobTitle  $jobtitle
     * @return \Illuminate\Http\Response
     */
    public function edit(JobTitle $jobtitle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobTitle  $jobtitle
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJobTitleRequest $request, JobTitle $jobtitle)
    {
        $validated = $request->validated();

        $jobtitle->name = $validated['name'] ?? null;
		$jobtitle->slug = Str::slug($validated['name']);
		$jobtitle->description = $validated['description'] ?? null;
		$jobtitle->icon_url = $validated['icon_url'] ?? null;

        $jobtitle->save();

        $data = [
            'success'       => true,
            'jobtitle'   => $jobtitle
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobTitle  $jobtitle
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobTitle $jobtitle)
    {
        $jobtitle->delete();

        $data = [
            'success' => true,
            'jobtitle' => $jobtitle
        ];

        return response()->json($data);
    }
}
