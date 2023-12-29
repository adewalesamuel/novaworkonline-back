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
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Auth\ApiUserAuthController;
use App\Http\Controllers\Auth\ApiAdminAuthController;
use App\Http\Controllers\Auth\ApiRecruiterAuthController;


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

Route::post('login', [ApiUserAuthController::class, 'login']);
Route::post('register', [ApiUserAuthController::class, 'register']);
Route::post('forgot-password', [ApiUserAuthController::class, 'forgot_password']);
Route::post('reset-password', [ApiUserAuthController::class, 'reset_password']);
Route::get('job-titles', [JobTitleController::class, 'index']);
Route::get('countries', [CountryController::class, 'index']);

Route::middleware(['auth.api_token'])->group(function () {
    Route::post('logout', [ApiUserAuthController::class, 'logout']);

    Route::get('profile', [UserController::class, 'profile']);
    Route::put('profile', [UserController::class, 'update_profile']);

    Route::get('profile/job-title-user', [JobTitleController::class, 'user_show']);

    Route::get('subscription-packs', [SubscriptionPackController::class, 'user_index']);

    Route::get('subscriptions', [SubscriptionController::class, 'user_index']);
    Route::post('subscriptions', [SubscriptionController::class, 'user_store']);
    Route::get('subscriptions/{subscription}', [SubscriptionController::class, 'user_show']);

    Route::get('test', [TestController::class, 'latest']);

    Route::get('user-test', [UserTestController::class, 'user_show']);
    Route::post('user-tests', [UserTestController::class, 'user_store']);

    Route::get('resume', [ResumeController::class, 'user_show']);
    Route::post('resume', [ResumeController::class, 'user_store']);
    Route::put('resume', [ResumeController::class, 'user_update']);
    Route::delete('resume', [ResumeController::class, 'user_destroy']);

    Route::get('analytics', [UserController::class, 'analytics']);

    Route::post('upload', [FileUploadController::class, 'store']);

});

Route::prefix('recruiter')->group(function () {
    Route::post('login', [ApiRecruiterAuthController::class, 'login']);
    Route::post('register', [ApiRecruiterAuthController::class, 'register']);
    Route::post('forgot-password', [ApiRecruiterAuthController::class, 'forgot_password']);
    Route::post('reset-password', [ApiRecruiterAuthController::class, 'reset_password']);
    Route::get('users/qualified', [UserController::class, 'qualified_index']);

    Route::middleware(['auth.api_token:recruiter'])->group(function () {
        Route::post('logout', [ApiRecruiterAuthController::class, 'logout']);

        Route::get('profile', [RecruiterController::class, 'profile']);
        Route::put('profile', [RecruiterController::class, 'update_profile']);

        Route::get('subscription-packs', [SubscriptionPackController::class, 'recruiter_index']);

        Route::get('subscriptions', [SubscriptionController::class, 'recruiter_index']);
        Route::post('subscriptions', [SubscriptionController::class, 'recruiter_store']);

        Route::get('users/{user}', [UserController::class, 'recruiter_show']);
        Route::get('users/{user}/resume', [ResumeController::class, 'resume']);

        Route::get('interview-requests', [InterviewRequestController::class, 'recruiter_index']);
        Route::post('interview-requests', [InterviewRequestController::class, 'recruiter_store']);
        Route::post('interview-requests/{interview_request}/reject', [InterviewRequestController::class, 'reject']);

        Route::get('employees', [EmployeeController::class, 'recruiter_index']);
        Route::post('employees', [EmployeeController::class, 'recruiter_store']);

        Route::get('projects', [ProjectController::class, 'recruiter_index']);
        Route::post('projects', [ProjectController::class, 'recruiter_store']);
        Route::get('projects/{project}', [ProjectController::class, 'recruiter_show']);
        Route::put('projects/{project}', [ProjectController::class, 'recruiter_update']);
        Route::delete('projects/{project}', [ProjectController::class, 'recruiter_destroy']);

        Route::get('analytics', [RecruiterController::class, 'analytics']);

        Route::post('upload', [FileUploadController::class, 'store']);

    });
});

Route::prefix('admin')->group(function () {
    Route::post('login', [ApiAdminAuthController::class, 'login']);

    Route::middleware(['auth.api_token:admin'])->group(function () {
        Route::post('logout', [ApiAdminAuthController::class, 'logout']);

        Route::get('analytics', [AdminController::class, 'analytics']);

        Route::get('profile', [AdminController::class, 'profile']);
        Route::put('profile', [AdminController::class, 'update_profile']);

        Route::post('upload', [FileUploadController::class, 'store']);

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

        Route::get('permissions', [PermissionController::class, 'index']);
        Route::post('permissions', [PermissionController::class, 'store']);
        Route::get('permissions/{permission}', [PermissionController::class, 'show']);
        Route::put('permissions/{permission}', [PermissionController::class, 'update']);
        Route::delete('permissions/{permission}', [PermissionController::class, 'destroy']);

        Route::get('job-titles', [JobTitleController::class, 'index']);
        Route::post('job-titles', [JobTitleController::class, 'store']);
        Route::get('job-titles/{job_title}', [JobTitleController::class, 'show']);
        Route::put('job-titles/{job_title}', [JobTitleController::class, 'update']);
        Route::delete('job-titles/{job_title}', [JobTitleController::class, 'destroy']);

        Route::get('admins', [AdminController::class, 'index']);
        Route::post('admins', [AdminController::class, 'store']);
        Route::get('admins/{admin}', [AdminController::class, 'show']);
        Route::put('admins/{admin}', [AdminController::class, 'update']);
        Route::delete('admins/{admin}', [AdminController::class, 'destroy']);

        Route::post('message', [AdminController::class, 'message']);

        Route::get('users', [UserController::class, 'index']);
        Route::post('users', [UserController::class, 'store']);
        Route::get('users/qualified', [UserController::class, 'qualified_index']);
        Route::post('users/{user}/qualify', [UserController::class, 'qualify']);
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

        Route::get('subscription-packs', [SubscriptionPackController::class, 'index']);
        Route::post('subscription-packs', [SubscriptionPackController::class, 'store']);
        Route::get('subscription-packs/{subscription_pack}', [SubscriptionPackController::class, 'show']);
        Route::put('subscription-packs/{subscription_pack}', [SubscriptionPackController::class, 'update']);
        Route::delete('subscription-packs/{subscription_pack}', [SubscriptionPackController::class, 'destroy']);

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

        Route::get('user-tests', [UserTestController::class, 'index']);
        Route::post('user-tests', [UserTestController::class, 'store']);
        Route::get('user-tests/{user_test}', [UserTestController::class, 'show']);
        Route::put('user-tests/{user_test}', [UserTestController::class, 'update']);
        Route::delete('user-tests/{user_test}', [UserTestController::class, 'destroy']);

        Route::get('projects', [ProjectController::class, 'index']);
        Route::post('projects', [ProjectController::class, 'store']);
        Route::get('projects/{project}', [ProjectController::class, 'show']);
        Route::put('projects/{project}', [ProjectController::class, 'update']);
        Route::delete('projects/{project}', [ProjectController::class, 'destroy']);

        Route::get('interview-requests', [InterviewRequestController::class, 'index']);
        Route::post('interview-requests', [InterviewRequestController::class, 'store']);
        Route::get('interview-requests/{interview_request}', [InterviewRequestController::class, 'show']);
        Route::put('interview-requests/{interview_request}', [InterviewRequestController::class, 'update']);
        Route::delete('interview-requests/{interview_request}', [InterviewRequestController::class, 'destroy']);

        Route::get('employees', [EmployeeController::class, 'index']);
        Route::post('employees', [EmployeeController::class, 'store']);
        Route::get('employees/{employee}', [EmployeeController::class, 'show']);
        Route::put('employees/{employee}', [EmployeeController::class, 'update']);
        Route::delete('employees/{employee}', [EmployeeController::class, 'destroy']);


    });

});

