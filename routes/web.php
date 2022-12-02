<?php

use Illuminate\Support\Facades\Route;

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



//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('includes.body');
})->name('index')->middleware('checkGuest');

Route::post('login', [App\Http\Controllers\AuthController::class, 'login_action'])->name('auth.login');//checked
Route::get('logout', [App\Http\Controllers\AuthController::class, 'logout_action'])->name('auth.logout');


Route::get('exercises', [App\Http\Controllers\TrainerController::class, 'exercises_index'])->name('exercises');
