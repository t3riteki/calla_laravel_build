<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\Auth\Logout;

use App\Http\Controllers\Resource\ClassroomController;
use App\Http\Controllers\Resource\ClassroomModuleController;
use App\Http\Controllers\Resource\EnrolledUserController;
use App\Http\Controllers\Resource\GlossaryController;
use App\Http\Controllers\Resource\LessonController;
use App\Http\Controllers\Resource\LogController;
use App\Http\Controllers\Resource\ModuleController;
use App\Http\Controllers\Resource\UserProgressController;
use App\Http\Controllers\Resource\DashboardController;

use Illuminate\Support\Facades\Route;

// Home route -> show login page
Route::view('/','landing')
->name('landing');

Route::view('/login', 'auth.login')
    ->middleware('guest')
    ->name('login');

Route::post('/login', Login::class)
    ->middleware('guest')
    ->name('register');

Route::view('/register', 'auth.register')
    ->middleware('guest');

Route::post('/register', Register::class)
    ->middleware('guest');

Route::middleware(['auth', 'auth.session'])->group(function () {

    // Navbar Routes
    Route::get('/logout', Logout::class);
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/profile', function () {
        return view(auth()->user()->role.'.profile');
    });

    Route::get('/settings', function () {
        return view(auth()->user()->role.'.settings');
    });

    // Resource Routes
    Route::resource('/logs', LogController::class);
    Route::resource('/enrolleduser', EnrolledUserController::class);
    Route::resource('/classrooms', ClassroomController::class);
    Route::resource('/classroommodule', ClassroomModuleController::class);
    Route::resource('/userprogress', UserProgressController::class);
    Route::resource('/modules', ModuleController::class);
    Route::resource('/lessons', LessonController::class);
    Route::resource('/glossary', GlossaryController::class);
});

// If you don’t have these yet, you can comment them out
// require __DIR__.'/settings.php';
// require __DIR__.'/auth.php';
