<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\ParseController;
use App\Http\Controllers\Resource\ClassroomController;
use App\Http\Controllers\Resource\ClassroomModuleController;
use App\Http\Controllers\Resource\EnrolledUserController;
use App\Http\Controllers\Resource\GlossaryController;
use App\Http\Controllers\Resource\LessonController;
use App\Http\Controllers\Resource\LogController;
use App\Http\Controllers\Resource\ModuleController;
use App\Http\Controllers\Resource\UserProgressController;
use App\Http\Controllers\Resource\DashboardController;
use App\Http\Controllers\Resource\UserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

    // Home route -> show login page
    Route::view('/','landing')
    ->name('landing');

    Route::view('/login', 'auth.login')
        ->middleware('guest')
        ->name('login');

    Route::post('/login', Login::class)
        ->middleware('guest')
        ->name('login');

    Route::view('/register', 'auth.register')
        ->middleware('guest');

    Route::post('/register', Register::class)
        ->middleware('guest');

    Route::middleware(['auth', 'auth.session'])->group(function () {

        // Navbar Routes
        Route::get('/logout', Logout::class);
        Route::get('/dashboard', [DashboardController::class, 'index']);

        Route::put('/password', [ProfileController::class, 'updatePassword'])
        ->name('password.update');
        Route::resource('/profile', ProfileController::class);
        Route::resource('/settings', SettingsController::class);

        // Resource Routes
        Route::resource('/logs', LogController::class);
        Route::resource('/enrolleduser', EnrolledUserController::class);
        Route::resource('/classrooms', ClassroomController::class);
        Route::post('/classrooms/{classroom}/join', [ClassroomController::class, 'join'])
        ->name('classrooms.join');

        Route::resource('/classroommodule', ClassroomModuleController::class);
        Route::resource('/userprogress', UserProgressController::class);
        Route::resource('/modules', ModuleController::class);
        Route::resource('/lessons', LessonController::class);
        Route::resource('/glossary', GlossaryController::class);
        Route::resource('/user', UserController::class);

        Route::post('/parse',[ParseController::class, 'parse']);

    });
