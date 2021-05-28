<?php

use Illuminate\Support\Facades\Route;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/', function () { return view('welcome'); });

Route::middleware(['auth','panelGuard'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
    Route::get('personel/sendCredentials/{id}', [PersonelController::class,'sendCredentials'])->name('personel.sendCredentials');
    Route::get('sendCredentials/{id}', [UserController::class,'sendCredentials'])->name('sendCredentials');
    Route::any('profileEdit', [UserController::class,'profileEdit'])->name('profileEdit');
    Route::resource('user', 'App\Http\Controllers\UserController');
    Route::resource('role', 'App\Http\Controllers\RoleController');
});
