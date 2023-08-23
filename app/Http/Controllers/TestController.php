<?php
namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTestRequest;
use App\Http\Requests\UpdateTestRequest;
use Illuminate\Support\Str;


class TestController extends Controller
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
            'tests' => Test::where('id', '>', -1)
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
    public function store(StoreTestRequest $request)
    {
        $validated = $request->validated();

        $test = new Test;

        $test->name = $validated['name'] ?? null;
		$test->slug = $validated['slug'] ?? null;
		$test->description = $validated['description'] ?? null;
		$test->cotent = $validated['cotent'] ?? null;
		
        $test->save();

        $data = [
            'success'       => true,
            'test'   => $test
        ];
        
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        $data = [
            'success' => true,
            'test' => $test
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTestRequest $request, Test $test)
    {
        $validated = $request->validated();

        $test->name = $validated['name'] ?? null;
		$test->slug = $validated['slug'] ?? null;
		$test->description = $validated['description'] ?? null;
		$test->cotent = $validated['cotent'] ?? null;
		
        $test->save();

        $data = [
            'success'       => true,
            'test'   => $test
        ];
        
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {   
        $test->delete();

        $data = [
            'success' => true,
            'test' => $test
        ];

        return response()->json($data);
    }
}