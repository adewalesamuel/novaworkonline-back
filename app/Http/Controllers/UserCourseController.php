<?php
namespace App\Http\Controllers;

use App\Models\UserCourse;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserCourseRequest;
use App\Http\Requests\UpdateUserCourseRequest;
use Illuminate\Support\Str;


class UserCourseController extends Controller
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
            'usercourses' => UserCourse::where('id', '>', -1)
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
    public function store(StoreUserCourseRequest $request)
    {
        $validated = $request->validated();

        $usercourse = new UserCourse;

        $usercourse->progress = $validated['progress'] ?? null;
		$usercourse->course_id = $validated['course_id'] ?? null;
		$usercourse->user_id = $validated['user_id'] ?? null;
		
        $usercourse->save();

        $data = [
            'success'       => true,
            'usercourse'   => $usercourse
        ];
        
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserCourse  $usercourse
     * @return \Illuminate\Http\Response
     */
    public function show(UserCourse $usercourse)
    {
        $data = [
            'success' => true,
            'usercourse' => $usercourse
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserCourse  $usercourse
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCourse $usercourse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserCourse  $usercourse
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserCourseRequest $request, UserCourse $usercourse)
    {
        $validated = $request->validated();

        $usercourse->progress = $validated['progress'] ?? null;
		$usercourse->course_id = $validated['course_id'] ?? null;
		$usercourse->user_id = $validated['user_id'] ?? null;
		
        $usercourse->save();

        $data = [
            'success'       => true,
            'usercourse'   => $usercourse
        ];
        
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserCourse  $usercourse
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserCourse $usercourse)
    {   
        $usercourse->delete();

        $data = [
            'success' => true,
            'usercourse' => $usercourse
        ];

        return response()->json($data);
    }
}