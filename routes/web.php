<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutSectionController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventRegistrationController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Api\GalleryApiController;
use App\Http\Controllers\AboutPageController;
use App\Http\Controllers\FitraaController;
use App\Http\Controllers\SadqaController;
use App\Http\Controllers\ZakatController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Auth\LoginController;

// Home Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// About Page Route
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Gallery API Routes
Route::get('/gallery/items', [GalleryController::class, 'getGalleryItems']);

// Events Routes
Route::prefix('events')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('events.index');
    Route::get('/{event:slug}', [EventController::class, 'show'])->name('events.show');
    
    // Event Registration Routes
    Route::get('/{event:title}/register', [EventRegistrationController::class, 'create'])
        ->name('event.registration.create');
    Route::post('/{event:title}/register', [EventRegistrationController::class, 'store'])
        ->name('events.register');
    Route::get('/registration/success', [EventRegistrationController::class, 'success'])
        ->name('registration.success');
});

// Gallery Routes
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

// Contact Form Route
Route::post('/contact', [\App\Http\Controllers\ContactController::class, '__invoke'])
    ->name('contact.submit');

// Donation Routes
Route::prefix('donate')->name('donation.')->group(function () {
    Route::get('fitraa', [FitraaController::class, 'index'])->name('fitraa');
    Route::get('sadqa', [SadqaController::class, 'index'])->name('sadqa');
    Route::get('zakat', [ZakatController::class, 'index'])->name('zakat');
});

// Public Notice Routes
Route::prefix('notices')->name('notices.')->group(function () {
    Route::get('/', [NoticeController::class, 'index'])->name('index');
    Route::get('{notice:slug}', [NoticeController::class, 'show'])->name('show');
    Route::get('{notice}/download', [NoticeController::class, 'download'])->name('download');
});

// Public Question Papers
Route::get('/question-papers', [\App\Http\Controllers\QuestionPaperController::class, 'index'])
    ->name('question-papers.index');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('user-login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Public routes accessible to all users
Route::middleware('guest')->group(function () {
    Route::get('/user-login', [LoginController::class, 'showLoginForm'])->name('user.login');
});

// API Routes
Route::prefix('api')->name('api.')->group(function () {
    Route::get('about-section', [AboutSectionController::class, 'getActiveSection']);
    Route::get('gallery/featured', [GalleryController::class, 'welcomeGallery']);
    Route::get('gallery/items', [GalleryController::class, 'getGalleryItems']);
});

// Redirect for backward compatibility
Route::get('/user-dashboard', function () {
    return redirect()->route('user.dashboard');
})->name('user-dashboard');

// Include User Routes
require __DIR__.'/user.php';

// Contact Page Routes
Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

// Privacy Policy Page
Route::get('/privacy-policy', function () {
    return view('pages.privacy');
})->name('privacy');

// Contact Form Submission
Route::post('/contact', [\App\Http\Controllers\ContactController::class, '__invoke'])
    ->name('contact.submit');

// Questions Paper Routes
Route::get('/question-papers', [\App\Http\Controllers\QuestionPaperController::class, 'index'])
    ->name('question-papers.index');

// Notice Routes (Public)
Route::prefix('notices')->name('notices.')->group(function () {
    Route::get('/', [NoticeController::class, 'index'])->name('index');
    Route::get('{notice}', [NoticeController::class, 'show'])->name('show');
    Route::get('{notice}/download', [NoticeController::class, 'download'])->name('download');
});
