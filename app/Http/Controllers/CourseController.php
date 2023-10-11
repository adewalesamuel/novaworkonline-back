<?php
namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Support\Str;


class CourseController extends Controller
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
            'courses' => Course::where('id', '>', -1)
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
    public function store(StoreCourseRequest $request)
    {
        $validated = $request->validated();

        $course = new Course;

        $course->name = $validated['name'] ?? null;
		$course->slug = Str::slug($validated['name']);
		$course->description = $validated['description'] ?? null;
		$course->estimated_length = $validated['estimated_length'] ?? null;
		$course->lesson_length = $validated['lesson_length'] ?? null;
		$course->cover_img_url = $validated['cover_img_url'] ?? null;
		$course->author = $validated['author'] ?? null;

        $course->save();

        $data = [
            'success'       => true,
            'course'   => $course
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $data = [
            'success' => true,
            'course' => $course
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $validated = $request->validated();

        $course->name = $validated['name'] ?? null;
		$course->slug = Str::slug($validated['name']);
		$course->description = $validated['description'] ?? null;
		$course->estimated_length = $validated['estimated_length'] ?? null;
		$course->lesson_length = $validated['lesson_length'] ?? null;
		$course->cover_img_url = $validated['cover_img_url'] ?? null;
		$course->author = $validated['author'] ?? null;

        $course->save();

        $data = [
            'success'       => true,
            'course'   => $course
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();

        $data = [
            'success' => true,
            'course' => $course
        ];

        return response()->json($data);
    }
}
