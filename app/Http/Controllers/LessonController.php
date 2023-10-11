<?php
namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use Illuminate\Support\Str;


class LessonController extends Controller
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
            'lessons' => Lesson::where('id', '>', -1)
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
    public function store(StoreLessonRequest $request)
    {
        $validated = $request->validated();

        $lesson = new Lesson;

        $lesson->name = $validated['name'] ?? null;
		$lesson->slug = Str::slug($validated['name']);
		$lesson->description = $validated['description'] ?? null;
		$lesson->content = $validated['content'] ?? null;
		$lesson->type = $validated['type'] ?? null;
		$lesson->estimated_length = $validated['estimated_length'] ?? null;
		$lesson->cover_img_url = $validated['cover_img_url'] ?? null;
		$lesson->course_id = $validated['course_id'] ?? null;

        $lesson->save();

        $data = [
            'success'       => true,
            'lesson'   => $lesson
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        $data = [
            'success' => true,
            'lesson' => $lesson
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLessonRequest $request, Lesson $lesson)
    {
        $validated = $request->validated();

        $lesson->name = $validated['name'] ?? null;
		$lesson->slug = Str::slug($validated['name']);
		$lesson->description = $validated['description'] ?? null;
		$lesson->content = $validated['content'] ?? null;
		$lesson->type = $validated['type'] ?? null;
		$lesson->estimated_length = $validated['estimated_length'] ?? null;
		$lesson->cover_img_url = $validated['cover_img_url'] ?? null;
		$lesson->course_id = $validated['course_id'] ?? null;

        $lesson->save();

        $data = [
            'success'       => true,
            'lesson'   => $lesson
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        $data = [
            'success' => true,
            'lesson' => $lesson
        ];

        return response()->json($data);
    }
}
