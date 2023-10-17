<?php
namespace App\Http\Controllers;

use App\Models\UserTest;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserTestRequest;
use App\Http\Requests\UpdateUserTestRequest;
use Illuminate\Support\Str;
use App\Http\Auth;



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
            'user_tests' => UserTest::where('id', '>', -1)
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
    public function store(StoreUserTestRequest $request)
    {
        $validated = $request->validated();

        $user_test = new UserTest;

        $user_test->test_id = $validated['test_id'] ?? null;
		$user_test->user_id = $validated['user_id'] ?? null;
		$user_test->status = $validated['status'] ?? null;
		$user_test->current_step = $validated['current_step'] ?? null;
		$user_test->score = $validated['score'] ?? null;

        $user_test->save();

        $data = [
            'success'       => true,
            'user_test'   => $user_test
        ];

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function user_store(StoreUserTestRequest $request)
    {
        $validated = $request->validated();
        $user = Auth::getUser($request, Auth::USER);

        $user_test = new UserTest;

        $user_test->test_id = $validated['test_id'] ?? null;
		$user_test->user_id = $user->id;
		$user_test->status = 'finished';
		$user_test->current_step = $validated['current_step'] ?? null;
		$user_test->score = $validated['score'] ?? null;

        $user_test->save();

        $data = [
            'success'       => true,
            'user_test'   => $user_test
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserTest  $user_test
     * @return \Illuminate\Http\Response
     */
    public function user_show(Request $request)
    {
        $user = Auth::getUser($request, Auth::USER);
        $user_test = UserTest::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')->firstOrFail();

        $data = [
            'success' => true,
            'user_test' => $user_test
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserTest  $user_test
     * @return \Illuminate\Http\Response
     */
    public function show(UserTest $user_test)
    {
        $data = [
            'success' => true,
            'user_test' => $user_test
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserTest  $user_test
     * @return \Illuminate\Http\Response
     */
    public function edit(UserTest $user_test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserTest  $user_test
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserTestRequest $request, UserTest $user_test)
    {
        $validated = $request->validated();

        $user_test->test_id = $validated['test_id'] ?? null;
		$user_test->user_id = $validated['user_id'] ?? null;
		$user_test->status = $validated['status'] ?? null;
		$user_test->current_step = $validated['current_step'] ?? null;
		$user_test->score = $validated['score'] ?? null;

        $user_test->save();

        $data = [
            'success'       => true,
            'user_test'   => $user_test
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserTest  $user_test
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserTest $user_test)
    {
        $user_test->delete();

        $data = [
            'success' => true,
            'user_test' => $user_test
        ];

        return response()->json($data);
    }
}
