<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ComingSoonController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth'])
    ->group(function () {
        
        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        // Categories - REAL CRUD
        Route::resource('categories', CategoryController::class);
        Route::post('categories/reorder', [CategoryController::class, 'reorder'])->name('categories.reorder');
        
        // Posts - REAL CRUD  
        Route::resource('posts', PostController::class);
        Route::post('posts/{post}/duplicate', [PostController::class, 'duplicate'])->name('posts.duplicate');
        Route::patch('posts/{post}/status', [PostController::class, 'updateStatus'])->name('posts.status');
        
        // Pages - Coming Soon
        Route::get('/pages', [ComingSoonController::class, 'pages'])->name('pages.index');
        Route::get('/pages/create', [ComingSoonController::class, 'pagesCreate'])->name('pages.create');
        
        // Health Services - Coming Soon
        Route::get('/services', [ComingSoonController::class, 'services'])->name('services.index');
        Route::get('/services/create', [ComingSoonController::class, 'servicesCreate'])->name('services.create');
        
        Route::get('/programs', [ComingSoonController::class, 'programs'])->name('programs.index');
        Route::get('/programs/create', [ComingSoonController::class, 'programsCreate'])->name('programs.create');
        
        Route::get('/facilities', [ComingSoonController::class, 'facilities'])->name('facilities.index');
        Route::get('/statistics', [ComingSoonController::class, 'statistics'])->name('statistics.index');
        Route::get('/statistics/create', [ComingSoonController::class, 'statisticsCreate'])->name('statistics.create');
        Route::get('/officials', [ComingSoonController::class, 'officials'])->name('officials.index');
        
        // Media & Files - Coming Soon
        Route::get('/media', [ComingSoonController::class, 'media'])->name('media.index');
        Route::get('/galleries', [ComingSoonController::class, 'galleries'])->name('galleries.index');
        Route::get('/downloads', [ComingSoonController::class, 'downloads'])->name('downloads.index');
        Route::get('/sliders', [ComingSoonController::class, 'sliders'])->name('sliders.index');
        
        // Communication - Coming Soon
        Route::get('/comments', [ComingSoonController::class, 'comments'])->name('comments.index');
        Route::get('/contacts', [ComingSoonController::class, 'contacts'])->name('contacts.index');
        
        // System - Coming Soon
        Route::get('/users', [ComingSoonController::class, 'users'])->name('users.index');
        Route::get('/settings', [ComingSoonController::class, 'settings'])->name('settings.index');
    });