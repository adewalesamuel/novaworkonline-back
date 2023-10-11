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

Route::get('/nouveau-motdepasse', function() {
    return "Erreur";
})->name('password.reset');

Route::get('/mon-cv/apercu/{token}', [UserController::class, 'resume_preview']);
Route::get('/candidats/{user}/cv', [UserController::class, 'resume']);
