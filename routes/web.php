<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TanqueController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;
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


Route::get('/', function () {
    return view('auth/login');
});

Route::resource('tanques', TanqueController::class);
Route::resource('clients', ClientController::class);
Route::resource('sensors', SensorController::class);
Auth::routes();
Route::resource('users', UserController::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
