<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherDashboard\DashboardController;
use App\Http\Controllers\TeacherDashboard\ProfileController;
use App\Http\Controllers\TeacherDashboard\StudentController;
use App\Http\Controllers\TeacherDashboard\AttendanceController;

/*
|--------------------------------------------------------------------------
| Teacher Routes
|--------------------------------------------------------------------------
|
| All authenticated teacher routes are defined here. These routes are loaded
| by the RouteServiceProvider within a group which contains the "web", "auth",
| and "teacher" middleware groups.
|
*/

Route::middleware(['auth', 'teacher', \App\Http\Middleware\MaintenanceMode::class])
    ->prefix('teacher')
    ->name('teacher.')
    ->group(function () {
        // Dashboard
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Profile
        Route::get('profile', [ProfileController::class, 'show'])->name('profile');
        Route::post('profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo');

        // Students
        Route::get('students', [StudentController::class, 'index'])->name('students.index');
        Route::get('students/{user}', [StudentController::class, 'show'])->name('students.show');

        // Attendance
        Route::prefix('attendance')->name('attendance.')->group(function () {
            Route::get('/', [AttendanceController::class, 'index'])->name('index');
            Route::get('take', [AttendanceController::class, 'create'])->name('create');
            Route::post('store', [AttendanceController::class, 'store'])->name('store');
            Route::get('history', [AttendanceController::class, 'history'])->name('history');
        });
    });
