<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Support\Str;
use App\Http\Auth;
use App\Models\InterviewRequest;
use Error;
use Exception;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
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
            'employees' => Employee::with(['user', 'recruiter'])
            ->where('id', '>', -1)->orderBy('created_at', 'desc')->paginate()
        ];

        return response()->json($data);
    }

    public function recruiter_index(Request $request)
    {
        $recruiter = Auth::getUser($request, Auth::RECRUITER);

        $data = [
            'success' => true,
            'employees' => Employee::with(['user']
            )->where('id', '>', -1)->where('recruiter_id', $recruiter->id)
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
    public function store(StoreEmployeeRequest $request)
    {
        $validated = $request->validated();

        $employee = new Employee;

        $employee->user_id = $validated['user_id'] ?? null;
		$employee->recruiter_id = $validated['recruiter_id'] ?? null;
		$employee->project_id = $validated['project_id'] ?? null;

        $employee->save();

        $data = [
            'success'       => true,
            'employee'   => $employee
        ];

        return response()->json($data);
    }

    public function recruiter_store(StoreEmployeeRequest $request)
    {
        $validated = $request->validated();
        $recruiter = Auth::getUser($request, Auth::RECRUITER);
        $user_id = $validated['user_id'];

        try {
            DB::beginTransaction();

            $hasEmployee = Employee::where('user_id', $user_id)
            ->where('recruiter_id', $recruiter->id)->first();

            if ($hasEmployee) throw new Exception(("L'employé exist déjà"));

            $employee = new Employee;
            $interview_request = InterviewRequest::where('recruiter_id',
            $recruiter->id)->where('user_id', $user_id)->firstOrFail();


            $interview_request->status = 'validated';

            $employee->user_id = $user_id ?? null;
            $employee->recruiter_id = $recruiter->id;
            $employee->project_id = $validated['project_id'] ?? null;

            $employee->save();
            $interview_request->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            $data = [
                'error' => true,
                'message' => $th->getMessage()
            ];

            return response()->json($data, 500);
        }

        $data = [
            'success'       => true,
            'employee'   => $employee
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        $data = [
            'success' => true,
            'employee' => $employee
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $validated = $request->validated();

        $employee->user_id = $validated['user_id'] ?? null;
		$employee->recruiter_id = $validated['recruiter_id'] ?? null;
		$employee->project_id = $validated['project_id'] ?? null;

        $employee->save();

        $data = [
            'success'       => true,
            'employee'   => $employee
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        $data = [
            'success' => true,
            'employee' => $employee
        ];

        return response()->json($data);
    }
}
