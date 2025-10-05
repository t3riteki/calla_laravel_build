<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Register;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Home route -> show login page
Route::view('/','landing');

Route::view('/login','auth.login')
->middleware('guest');
Route::post('/login',Login::class)
->middleware('guest');

Route::view('/register','auth.register')
->middleware('guest');
Route::post('/register',Register::class)
->middleware('guest');

// If you don’t have these yet, you can comment them out
// require __DIR__.'/settings.php';
// require __DIR__.'/auth.php';
