<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');


Route::get('/get-started', function () {
    return view('get-started');
})->name('get-started');