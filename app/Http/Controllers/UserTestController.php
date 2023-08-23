<?php
namespace App\Http\Controllers;

use App\Models\UserTest;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserTestRequest;
use App\Http\Requests\UpdateUserTestRequest;
use Illuminate\Support\Str;


class UserTestController extends Controller
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
            'usertests' => UserTest::where('id', '>', -1)
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
    public function store(StoreUserTestRequest $request)
    {
        $validated = $request->validated();

        $usertest = new UserTest;

        $usertest->test_id = $validated['test_id'] ?? null;
		$usertest->user_id = $validated['user_id'] ?? null;
		$usertest->status = $validated['status'] ?? null;
		$usertest->current_step = $validated['current_step'] ?? null;
		$usertest->score = $validated['score'] ?? null;
		
        $usertest->save();

        $data = [
            'success'       => true,
            'usertest'   => $usertest
        ];
        
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserTest  $usertest
     * @return \Illuminate\Http\Response
     */
    public function show(UserTest $usertest)
    {
        $data = [
            'success' => true,
            'usertest' => $usertest
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserTest  $usertest
     * @return \Illuminate\Http\Response
     */
    public function edit(UserTest $usertest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserTest  $usertest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserTestRequest $request, UserTest $usertest)
    {
        $validated = $request->validated();

        $usertest->test_id = $validated['test_id'] ?? null;
		$usertest->user_id = $validated['user_id'] ?? null;
		$usertest->status = $validated['status'] ?? null;
		$usertest->current_step = $validated['current_step'] ?? null;
		$usertest->score = $validated['score'] ?? null;
		
        $usertest->save();

        $data = [
            'success'       => true,
            'usertest'   => $usertest
        ];
        
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserTest  $usertest
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserTest $usertest)
    {   
        $usertest->delete();

        $data = [
            'success' => true,
            'usertest' => $usertest
        ];

        return response()->json($data);
    }
}