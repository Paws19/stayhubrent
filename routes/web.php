<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');


Route::get('/get-started', function () {
    return view('get-started');
})->name('get-started');

Route::post('/register', [App\Http\Controllers\RegisterController::class, 'store'])
    ->name('register.store');

Route::post('/role', [App\Http\Controllers\AccountController::class, 'store'])
    ->name('role.store');

Route::post('/landlord-details', [App\Http\Controllers\LandlordDetailController::class, 'store'])
    ->name('landlord-details.store');