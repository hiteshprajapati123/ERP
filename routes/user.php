<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDashboard\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\UserDashboard\UserNoticeController;
use App\Http\Controllers\ExamResultController;
use App\Http\Controllers\FeeController;

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
| All authenticated user routes are defined here. These routes are loaded
| by the RouteServiceProvider within a group which contains the "web" and "auth"
| middleware groups.
|
*/

Route::middleware(['auth', \App\Http\Middleware\MaintenanceMode::class])->prefix('user')->name('user.')->group(function () {
    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile', 'show')->name('profile');
        Route::put('profile', 'update')->name('profile.update');
    });
    
    // Attendance
    Route::prefix('attendance')->name('attendance.')->group(function () {
        Route::get('/', [AttendanceController::class, 'index'])->name('index');
    });
    
    // Notices (User Dashboard)
    Route::prefix('notices')->name('notices.')->group(function () {
        Route::get('/', [UserNoticeController::class, 'index'])->name('index');
        Route::get('{notice:slug}', [UserNoticeController::class, 'show'])->name('show');
        Route::get('{notice}/download', [UserNoticeController::class, 'download'])->name('download');
        Route::get('image/{path}', [UserNoticeController::class, 'serveImage'])
            ->where('path', '.*')
            ->name('image');
    });
    
    // Exam Results
    Route::prefix('exam-results')->name('exam.results.')->group(function () {
        Route::get('/', [ExamResultController::class, 'index'])->name('index');
        Route::get('{examResult}', [ExamResultController::class, 'show'])->name('show');
        Route::get('api/summary', [ExamResultController::class, 'summary'])->name('api.summary');
    });
    
    // Fees
    Route::get('fees', [FeeController::class, 'indexPage'])->name('fees');
});
