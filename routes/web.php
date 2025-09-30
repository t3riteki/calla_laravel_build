<?php

use Illuminate\Support\Facades\Route;

// Home route -> show login page
Route::get('/', function () {
    return view('layouts.auth.login'); // ✅ correct path
})->name('login');

// If you don’t have these yet, you can comment them out
// require __DIR__.'/settings.php';
// require __DIR__.'/auth.php';
