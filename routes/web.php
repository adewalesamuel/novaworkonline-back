<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/mon-cv/apercu/{token}', [UserController::class, 'resume_preview']);
Route::get('/candidats/{user}/cv', [UserController::class, 'resume']);

Route::domain('admin.novaworkonline.com')->group(function(){
    Route::get('/{any}', function () {
        return view('admin');
    })->where('any', '.*');
});
Route::domain('recruteur.localhost.test')->group(function(){
    Route::get('/{any}', function () {
        return view('recruiter');
    })->where('any', '.*');
});

Route::get('/{any}', function () {
    return view('user');
})->where('any', '.*');
