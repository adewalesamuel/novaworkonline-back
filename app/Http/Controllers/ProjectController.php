<?php
namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Str;
use App\Http\Auth;


class ProjectController extends Controller
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
            'projects' => Project::where('id', '>', -1)
            ->orderBy('created_at', 'desc')->get()
        ];

        return response()->json($data);
    }

    public function recruiter_index(Request $request)
    {
        $recruiter = Auth::getUser($request, Auth::RECRUITER);

        $data = [
            'success' => true,
            'projects' => Project::where('id', '>', -1)
            ->where('recruiter_id', $recruiter->id)
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
    public function store(StoreProjectRequest $request)
    {
        $validated = $request->validated();

        $project = new Project;

        $project->name = $validated['name'] ?? null;
		$project->slug = Str::slug($validated['name']);
		$project->description = $validated['description'] ?? null;
		$project->recruiter_id = $validated['recruiter_id'] ?? null;

        $project->save();

        $data = [
            'success'       => true,
            'project'   => $project
        ];

        return response()->json($data);
    }

    public function recruiter_store(StoreProjectRequest $request)
    {
        $validated = $request->validated();
        $recruiter = Auth::getUser($request, Auth::RECRUITER);

        $project = new Project;

        $project->name = $validated['name'] ?? null;
		$project->slug = Str::slug($validated['name']);
		$project->description = $validated['description'] ?? null;
		$project->recruiter_id = $recruiter->id;

        $project->save();

        $data = [
            'success'       => true,
            'project'   => $project
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $data = [
            'success' => true,
            'project' => $project
        ];

        return response()->json($data);
    }

    public function recruiter_show(Request $request, Project $project)
    {
        $recruiter = Auth::getUser($request, Auth::RECRUITER);

        $data = [
            'success' => true,
            'project' => Project::where('recruiter_id', $recruiter->id)
            ->where('id', $project->id)->firstOrFail()
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $validated = $request->validated();

        $project->name = $validated['name'] ?? null;
		$project->slug = Str::slug($validated['name']);
		$project->description = $validated['description'] ?? null;
		$project->recruiter_id = $validated['recruiter_id'] ?? null;

        $project->save();

        $data = [
            'success'       => true,
            'project'   => $project
        ];

        return response()->json($data);
    }

    public function recruiter_update(UpdateProjectRequest $request, Project $project)
    {
        $validated = $request->validated();
        $recruiter = Auth::getUser($request, Auth::RECRUITER);

        $project->name = $validated['name'] ?? null;
		$project->slug = Str::slug($validated['name']);
		$project->description = $validated['description'] ?? null;

        $project->save();

        $data = [
            'success'       => true,
            'project'   => $project
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        $data = [
            'success' => true,
            'project' => $project
        ];

        return response()->json($data);
    }
}
