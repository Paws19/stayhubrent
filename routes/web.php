<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\LandlordDetailController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/login', function () {return view('auth.login');
})->name('login');
Route::post('/login', [App\Http\Controllers\AccountController::class, 'login'])
    ->name('login.store');
Route::get('/get-started', [LandlordDetailController::class, 'show'])
    ->name('get-started');
Route::post('/register', [App\Http\Controllers\RegisterController::class, 'store'])
    ->name('register.store');
Route::post('/send-otp', [App\Http\Controllers\RegisterController::class, 'sendOTP'])
    ->name('send-otp');

Route::post('/verify-otp', [App\Http\Controllers\RegisterController::class, 'verifyOTP'])
    ->name('verify-otp');
Route::post('/role', [App\Http\Controllers\AccountController::class, 'store'])
    ->name('role.store');
Route::post('/landlord-details', [App\Http\Controllers\LandlordDetailController::class, 'store'])
    ->name('landlord-details.store');


//Dashboard routes
Route::get('/dashboard/landlord', [App\Http\Controllers\Dashboard\LandlordController::class, 'index'])
    ->name('dashboard.landlord');

Route::get('/dashboard/tenant', [App\Http\Controllers\Dashboard\TenantController::class, 'index'])
    ->name('dashboard.tenant');
