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
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile_index'])->name('profile');
Route::post('change-about-me', [App\Http\Controllers\HomeController::class, 'change_about_me'])->name('change-about-me');
Route::post('change-my-data', [App\Http\Controllers\HomeController::class, 'change_my_data'])->name('change-my-data');
Route::post('/change-security', [App\Http\Controllers\HomeController::class, 'change_security'])->name('change-security');

Route::get('/forgot-password-index', function () {
    return view('auth.forgot_password');
})->name('forgot-password')->middleware('checkGuest');

Route::get('/', function () {
    return view('includes.body');
})->name('index')->middleware('checkGuest');

Route::post('login', [App\Http\Controllers\AuthController::class, 'login_action'])->name('auth.login');//checked
Route::get('logout', [App\Http\Controllers\AuthController::class, 'logout_action'])->name('auth.logout');
Route::post('forgot-password-send', [App\Http\Controllers\AuthController::class, 'fg_password'])->name('auth.forgot-password-send');//checked
Route::get('forgot-password-send/{hash}', [App\Http\Controllers\AuthController::class, 'fg_password_hash'])->name('auth.new-password-hashed');//checked
Route::post('change-password', [App\Http\Controllers\AuthController::class, 'change_password'])->name('auth.change-password');//checked

Route::get('exercises', [App\Http\Controllers\TrainerController::class, 'exercises_index'])->name('exercises');
Route::post('remove-exercise', [App\Http\Controllers\TrainerController::class, 'remove_exercise'])->name('remove_exercise');
Route::post('add-exercise', [App\Http\Controllers\TrainerController::class, 'add_exercise'])->name('add_exercise');
Route::post('edit-exercise', [App\Http\Controllers\TrainerController::class, 'edit_exercise'])->name('edit_exercise');

Route::get('aliments', [App\Http\Controllers\TrainerController::class, 'aliments_index'])->name('aliments');
Route::post('remove-aliment', [App\Http\Controllers\TrainerController::class, 'remove_aliment'])->name('remove_aliment');
Route::post('add-aliment', [App\Http\Controllers\TrainerController::class, 'add_aliment'])->name('add_aliment');
Route::post('edit-aliment', [App\Http\Controllers\TrainerController::class, 'edit_aliment'])->name('edit_aliment');

Route::get('clients', [App\Http\Controllers\TrainerController::class, 'clients_index'])->name('clients');
Route::post('add-client', [App\Http\Controllers\TrainerController::class, 'add_client'])->name('add_client');
Route::post('ban-client', [App\Http\Controllers\TrainerController::class, 'ban_client'])->name('ban_client');

Route::get('nutritional-plan/{client}', [App\Http\Controllers\TrainerController::class, 'nutritional_plan_index'])->name('nutritional-plan');
Route::get('training-plan/{client}', [App\Http\Controllers\TrainerController::class, 'training_plan_index'])->name('training-plan');

Route::post('add-meal', [App\Http\Controllers\TrainerController::class, 'add_meal'])->name('add-meal');
Route::post('edit-meal', [App\Http\Controllers\TrainerController::class, 'edit_meal'])->name('edit-meal');
Route::post('add-aliment-pn', [App\Http\Controllers\TrainerController::class, 'add_aliment_pn'])->name('add-aliment-pn');
Route::post('edit-aliment-pn', [App\Http\Controllers\TrainerController::class, 'edit_aliment_pn'])->name('edit-aliment-pn');
Route::post('remove-meal', [App\Http\Controllers\TrainerController::class, 'remove_meal'])->name('remove-meal');
Route::post('remove-aliment-pn', [App\Http\Controllers\TrainerController::class, 'remove_aliment_pn'])->name('remove-aliment-pn');

Route::post('add-day', [App\Http\Controllers\TrainerController::class, 'add_day'])->name('add-day');
Route::post('add-exercise-pe', [App\Http\Controllers\TrainerController::class, 'add_exercise_pe'])->name('add-exercise-pe');
Route::post('remove-day', [App\Http\Controllers\TrainerController::class, 'remove_day'])->name('remove-day');
Route::post('edit-day', [App\Http\Controllers\TrainerController::class, 'edit_day'])->name('edit-day');
Route::post('remove-exercise-pe', [App\Http\Controllers\TrainerController::class, 'remove_exercise_pe'])->name('remove-exercise-pe');
Route::post('edit-exercise-pe', [App\Http\Controllers\TrainerController::class, 'edit_exercise_pe'])->name('edit-exercise-pe');

Route::get('pn-client', [App\Http\Controllers\ClientController::class, 'pn_client'])->name('pn-client');
Route::get('pe-client', [App\Http\Controllers\ClientController::class, 'pe_client'])->name('pe-client');



