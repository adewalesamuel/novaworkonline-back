<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\JobTitleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RecruiterController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\UserCourseController;
use App\Http\Controllers\SubscriptionPackController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserTestController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\InterviewRequestController;
use App\Http\Controllers\EmployeeController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('countries', [CountryController::class, 'index']);
Route::post('countries', [CountryController::class, 'store']);
Route::get('countries/{country}', [CountryController::class, 'show']);
Route::put('countries/{country}', [CountryController::class, 'update']);
Route::delete('countries/{country}', [CountryController::class, 'destroy']);

Route::get('roles', [RoleController::class, 'index']);
Route::post('roles', [RoleController::class, 'store']);
Route::get('roles/{role}', [RoleController::class, 'show']);
Route::put('roles/{role}', [RoleController::class, 'update']);
Route::delete('roles/{role}', [RoleController::class, 'destroy']);

Route::get('jobtitles', [JobTitleController::class, 'index']);
Route::post('jobtitles', [JobTitleController::class, 'store']);
Route::get('jobtitles/{jobtitle}', [JobTitleController::class, 'show']);
Route::put('jobtitles/{jobtitle}', [JobTitleController::class, 'update']);
Route::delete('jobtitles/{jobtitle}', [JobTitleController::class, 'destroy']);

Route::get('admins', [AdminController::class, 'index']);
Route::post('admins', [AdminController::class, 'store']);
Route::get('admins/{admin}', [AdminController::class, 'show']);
Route::put('admins/{admin}', [AdminController::class, 'update']);
Route::delete('admins/{admin}', [AdminController::class, 'destroy']);

Route::get('users', [UserController::class, 'index']);
Route::post('users', [UserController::class, 'store']);
Route::get('users/{user}', [UserController::class, 'show']);
Route::put('users/{user}', [UserController::class, 'update']);
Route::delete('users/{user}', [UserController::class, 'destroy']);

Route::get('recruiters', [RecruiterController::class, 'index']);
Route::post('recruiters', [RecruiterController::class, 'store']);
Route::get('recruiters/{recruiter}', [RecruiterController::class, 'show']);
Route::put('recruiters/{recruiter}', [RecruiterController::class, 'update']);
Route::delete('recruiters/{recruiter}', [RecruiterController::class, 'destroy']);

Route::get('resumes', [ResumeController::class, 'index']);
Route::post('resumes', [ResumeController::class, 'store']);
Route::get('resumes/{resume}', [ResumeController::class, 'show']);
Route::put('resumes/{resume}', [ResumeController::class, 'update']);
Route::delete('resumes/{resume}', [ResumeController::class, 'destroy']);

Route::get('courses', [CourseController::class, 'index']);
Route::post('courses', [CourseController::class, 'store']);
Route::get('courses/{course}', [CourseController::class, 'show']);
Route::put('courses/{course}', [CourseController::class, 'update']);
Route::delete('courses/{course}', [CourseController::class, 'destroy']);

Route::get('lessons', [LessonController::class, 'index']);
Route::post('lessons', [LessonController::class, 'store']);
Route::get('lessons/{lesson}', [LessonController::class, 'show']);
Route::put('lessons/{lesson}', [LessonController::class, 'update']);
Route::delete('lessons/{lesson}', [LessonController::class, 'destroy']);

Route::get('usercourses', [UserCourseController::class, 'index']);
Route::post('usercourses', [UserCourseController::class, 'store']);
Route::get('usercourses/{usercourse}', [UserCourseController::class, 'show']);
Route::put('usercourses/{usercourse}', [UserCourseController::class, 'update']);
Route::delete('usercourses/{usercourse}', [UserCourseController::class, 'destroy']);

Route::get('subscriptionpacks', [SubscriptionPackController::class, 'index']);
Route::post('subscriptionpacks', [SubscriptionPackController::class, 'store']);
Route::get('subscriptionpacks/{subscriptionpack}', [SubscriptionPackController::class, 'show']);
Route::put('subscriptionpacks/{subscriptionpack}', [SubscriptionPackController::class, 'update']);
Route::delete('subscriptionpacks/{subscriptionpack}', [SubscriptionPackController::class, 'destroy']);

Route::get('subscriptions', [SubscriptionController::class, 'index']);
Route::post('subscriptions', [SubscriptionController::class, 'store']);
Route::get('subscriptions/{subscription}', [SubscriptionController::class, 'show']);
Route::put('subscriptions/{subscription}', [SubscriptionController::class, 'update']);
Route::delete('subscriptions/{subscription}', [SubscriptionController::class, 'destroy']);

Route::get('tests', [TestController::class, 'index']);
Route::post('tests', [TestController::class, 'store']);
Route::get('tests/{test}', [TestController::class, 'show']);
Route::put('tests/{test}', [TestController::class, 'update']);
Route::delete('tests/{test}', [TestController::class, 'destroy']);

Route::get('usertests', [UserTestController::class, 'index']);
Route::post('usertests', [UserTestController::class, 'store']);
Route::get('usertests/{usertest}', [UserTestController::class, 'show']);
Route::put('usertests/{usertest}', [UserTestController::class, 'update']);
Route::delete('usertests/{usertest}', [UserTestController::class, 'destroy']);

Route::get('projects', [ProjectController::class, 'index']);
Route::post('projects', [ProjectController::class, 'store']);
Route::get('projects/{project}', [ProjectController::class, 'show']);
Route::put('projects/{project}', [ProjectController::class, 'update']);
Route::delete('projects/{project}', [ProjectController::class, 'destroy']);

Route::get('interviewrequests', [InterviewRequestController::class, 'index']);
Route::post('interviewrequests', [InterviewRequestController::class, 'store']);
Route::get('interviewrequests/{interviewrequest}', [InterviewRequestController::class, 'show']);
Route::put('interviewrequests/{interviewrequest}', [InterviewRequestController::class, 'update']);
Route::delete('interviewrequests/{interviewrequest}', [InterviewRequestController::class, 'destroy']);

Route::get('employees', [EmployeeController::class, 'index']);
Route::post('employees', [EmployeeController::class, 'store']);
Route::get('employees/{employee}', [EmployeeController::class, 'show']);
Route::put('employees/{employee}', [EmployeeController::class, 'update']);
Route::delete('employees/{employee}', [EmployeeController::class, 'destroy']);


