<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

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
    return view('authentication.register');
});
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'authenticating']);
Route::get('logout', [AuthController::class, 'logout']);
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class,  'registerProcess'])->name('registerProcess');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
