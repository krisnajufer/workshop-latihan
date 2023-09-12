<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard.index');
    });

    Route::controller(StudentController::class)->group(function () {
        Route::get('/student', 'index')->name('student.index');
        Route::get('/student/create', 'create')->name('student.create');
        Route::post('/student/store', 'store')->name('student.store');
        Route::get('/student/destroy/{id}', 'destroy')->name('student.destroy');
    });

    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::controller(AuthController::class)->middleware('guest')->group(function () {
    Route::get('/login', 'indexLogin')->name('auth.index.login');
    Route::get('/register', 'indexRegister')->name('auth.index.register');
    Route::post('/register', 'register')->name('auth.register');
    Route::post('/login', 'login')->name('auth.login');
});
