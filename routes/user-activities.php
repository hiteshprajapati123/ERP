<?php

use App\Http\Controllers\UserActivityController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/user/activities', [UserActivityController::class, 'index'])
        ->name('user.activities');
});
