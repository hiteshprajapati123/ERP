<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;

// Gallery Routes
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

// Secure image route for private gallery images
Route::get('/galleries/image/{path}', [GalleryController::class, 'image'])
    ->where('path', '.*')
    ->name('galleries.image');

// API Routes for Gallery
Route::prefix('api/gallery')->group(function () {
    Route::get('/featured', [GalleryController::class, 'welcomeGallery']);
    Route::get('/items', [GalleryController::class, 'getGalleryItems']);
});
