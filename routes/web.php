<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ClassroomModuleController;
use App\Http\Controllers\EnrolledUserController;
use App\Http\Controllers\GlossaryController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\UserProgressController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth', 'auth.session'])->group(function () {

    Route::get('/dashboard', function(){
        $user = Auth::user();
        return view('dashboard', compact(['user' => $user]));
    });

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
