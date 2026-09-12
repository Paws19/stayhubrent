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
Route::post('/tenant-details', [App\Http\Controllers\TenantDetailsController::class, 'store'])
    ->name('tenant-details.store');


// ========================================
// DASHBOARD ROUTES
// ========================================

// LANDLORD DASHBOARD
Route::get('/dashboard/landlord', [
    App\Http\Controllers\Dashboard\LandlordController::class,
    'index'
])->middleware(['auth', 'role:landlord'])->name('dashboard.landlord');

//Add new apartment
Route::post('/add-new-apartment', [App\Http\Controllers\Dashboard\LandlordController::class, 'AddNewApartment'])
    ->middleware(['auth', 'role:landlord'])
    ->name('add-new-apartment.store');



Route::post('/logout', [App\Http\Controllers\AccountController::class, 'logout'])
    ->middleware('auth')
    ->name('logout.store');


// TENANT DASHBOARD
Route::get('/dashboard/tenant', [
    App\Http\Controllers\Dashboard\TenantController::class,
    'index'
])
    ->middleware(['auth', 'role:tenant'])
    ->name('dashboard.tenant');

Route::post('/request-maintenance', [App\Http\Controllers\MaintenanceRequestController::class, 'store'])
    ->middleware('auth')
    ->name('request-maintenance.store');

Route::post('/logout', [App\Http\Controllers\AccountController::class, 'logout'])
    ->middleware('auth')
    ->name('logout.store');
