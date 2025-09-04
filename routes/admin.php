<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ComingSoonController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes - CLEAN & SIMPLE
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth'])
    ->group(function () {
        
        // Dashboard - Working controller
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        // Content Management
        Route::get('/posts', [ComingSoonController::class, 'posts'])->name('posts.index');
        Route::get('/posts/create', [ComingSoonController::class, 'postsCreate'])->name('posts.create');
        
        Route::get('/pages', [ComingSoonController::class, 'pages'])->name('pages.index');
        Route::get('/pages/create', [ComingSoonController::class, 'pagesCreate'])->name('pages.create');
        
        Route::get('/categories', [ComingSoonController::class, 'categories'])->name('categories.index');
        
        // Health Services
        Route::get('/services', [ComingSoonController::class, 'services'])->name('services.index');
        Route::get('/services/create', [ComingSoonController::class, 'servicesCreate'])->name('services.create');
        
        Route::get('/programs', [ComingSoonController::class, 'programs'])->name('programs.index');
        Route::get('/programs/create', [ComingSoonController::class, 'programsCreate'])->name('programs.create');
        
        Route::get('/facilities', [ComingSoonController::class, 'facilities'])->name('facilities.index');
        
        Route::get('/statistics', [ComingSoonController::class, 'statistics'])->name('statistics.index');
        Route::get('/statistics/create', [ComingSoonController::class, 'statisticsCreate'])->name('statistics.create');
        
        Route::get('/officials', [ComingSoonController::class, 'officials'])->name('officials.index');
        
        // Media & Files
        Route::get('/media', [ComingSoonController::class, 'media'])->name('media.index');
        Route::get('/galleries', [ComingSoonController::class, 'galleries'])->name('galleries.index');
        Route::get('/downloads', [ComingSoonController::class, 'downloads'])->name('downloads.index');
        Route::get('/sliders', [ComingSoonController::class, 'sliders'])->name('sliders.index');
        
        // Communication
        Route::get('/comments', [ComingSoonController::class, 'comments'])->name('comments.index');
        Route::get('/contacts', [ComingSoonController::class, 'contacts'])->name('contacts.index');
        
        // SuperAdmin only routes
        Route::get('/users', [ComingSoonController::class, 'users'])->name('users.index');
        Route::get('/settings', [ComingSoonController::class, 'settings'])->name('settings.index');
    });