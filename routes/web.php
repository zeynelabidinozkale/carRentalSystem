<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CheckoutController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/reservation', [App\Http\Controllers\HomeController::class, 'reservation'])->name('home.reservation');
Route::post('/home/reservation/checkout', [App\Http\Controllers\HomeController::class, 'checkout'])->name('home.reservation.checkout');
Route::get('/home/reservation/checkout_', [App\Http\Controllers\HomeController::class, 'getCheckoutForm'])->name('home.reservation.checkout_');
Route::any('/reservation/checkout/paymentCallback', [App\Http\Controllers\HomeController::class, 'paymentCallback'])->name('home.reservation.paymentCallback');
Route::get('/reservation/track', [App\Http\Controllers\HomeController::class, 'track'])->name('home.reservation.track');
Route::post('/reservation/trackResult', [App\Http\Controllers\HomeController::class, 'trackResult'])->name('home.reservation.trackResult');


Route::middleware(['auth','accountGuard'])->group(function () {
    Route::any('/account/index', [AccountController::class,'index'])->name('account.index');
    Route::any('/account/reservations', [AccountController::class,'reservations'])->name('account.reservations');
    Route::any('/account/reservationDetails', [AccountController::class,'reservationDetails'])->name('account.reservationDetails');
    Route::any('/account/update', [AccountController::class,'update'])->name('account.update');
});


//Route::get('/', function () { return view('welcome'); });


Route::middleware(['auth','panelGuard'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
    Route::get('sendCredentials/{id}', [UserController::class,'sendCredentials'])->name('sendCredentials');
    Route::any('profileEdit', [UserController::class,'profileEdit'])->name('profileEdit');
    Route::resource('user', 'App\Http\Controllers\UserController');
    Route::resource('role', 'App\Http\Controllers\RoleController');
    Route::resource('fueltype', 'App\Http\Controllers\FueltypeController');
    Route::resource('geartype', 'App\Http\Controllers\GeartypeController');
    Route::resource('vclass', 'App\Http\Controllers\VclassController');
    Route::resource('office', 'App\Http\Controllers\OfficeController');
    Route::resource('vehicle', 'App\Http\Controllers\VehicleController');
});
