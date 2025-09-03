<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ComingSoonController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes - COMPLETE SET
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth'])
    ->group(function () {
        
        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        // Content Management
        Route::get('/posts', [ComingSoonController::class, 'posts'])->name('posts.index');
        Route::get('/posts/create', [ComingSoonController::class, 'postsCreate'])->name('posts.create');
        Route::post('/posts', [ComingSoonController::class, 'postsStore'])->name('posts.store');
        Route::get('/posts/{id}', [ComingSoonController::class, 'postsShow'])->name('posts.show');
        Route::get('/posts/{id}/edit', [ComingSoonController::class, 'postsEdit'])->name('posts.edit');
        Route::put('/posts/{id}', [ComingSoonController::class, 'postsUpdate'])->name('posts.update');
        Route::delete('/posts/{id}', [ComingSoonController::class, 'postsDestroy'])->name('posts.destroy');
        
        Route::get('/pages', [ComingSoonController::class, 'pages'])->name('pages.index');
        Route::get('/pages/create', [ComingSoonController::class, 'pagesCreate'])->name('pages.create');
        Route::post('/pages', [ComingSoonController::class, 'pagesStore'])->name('pages.store');
        Route::get('/pages/{id}', [ComingSoonController::class, 'pagesShow'])->name('pages.show');
        Route::get('/pages/{id}/edit', [ComingSoonController::class, 'pagesEdit'])->name('pages.edit');
        Route::put('/pages/{id}', [ComingSoonController::class, 'pagesUpdate'])->name('pages.update');
        Route::delete('/pages/{id}', [ComingSoonController::class, 'pagesDestroy'])->name('pages.destroy');
        
        Route::get('/categories', [ComingSoonController::class, 'categories'])->name('categories.index');
        Route::get('/categories/create', [ComingSoonController::class, 'categoriesCreate'])->name('categories.create');
        Route::post('/categories', [ComingSoonController::class, 'categoriesStore'])->name('categories.store');
        Route::get('/categories/{id}', [ComingSoonController::class, 'categoriesShow'])->name('categories.show');
        Route::get('/categories/{id}/edit', [ComingSoonController::class, 'categoriesEdit'])->name('categories.edit');
        Route::put('/categories/{id}', [ComingSoonController::class, 'categoriesUpdate'])->name('categories.update');
        Route::delete('/categories/{id}', [ComingSoonController::class, 'categoriesDestroy'])->name('categories.destroy');
        
        // Health Services
        Route::get('/services', [ComingSoonController::class, 'services'])->name('services.index');
        Route::get('/services/create', [ComingSoonController::class, 'servicesCreate'])->name('services.create');
        Route::post('/services', [ComingSoonController::class, 'servicesStore'])->name('services.store');
        Route::get('/services/{id}', [ComingSoonController::class, 'servicesShow'])->name('services.show');
        Route::get('/services/{id}/edit', [ComingSoonController::class, 'servicesEdit'])->name('services.edit');
        Route::put('/services/{id}', [ComingSoonController::class, 'servicesUpdate'])->name('services.update');
        Route::delete('/services/{id}', [ComingSoonController::class, 'servicesDestroy'])->name('services.destroy');
        
        Route::get('/programs', [ComingSoonController::class, 'programs'])->name('programs.index');
        Route::get('/programs/create', [ComingSoonController::class, 'programsCreate'])->name('programs.create');
        Route::post('/programs', [ComingSoonController::class, 'programsStore'])->name('programs.store');
        Route::get('/programs/{id}', [ComingSoonController::class, 'programsShow'])->name('programs.show');
        Route::get('/programs/{id}/edit', [ComingSoonController::class, 'programsEdit'])->name('programs.edit');
        Route::put('/programs/{id}', [ComingSoonController::class, 'programsUpdate'])->name('programs.update');
        Route::delete('/programs/{id}', [ComingSoonController::class, 'programsDestroy'])->name('programs.destroy');
        
        Route::get('/facilities', [ComingSoonController::class, 'facilities'])->name('facilities.index');
        Route::get('/facilities/create', [ComingSoonController::class, 'facilitiesCreate'])->name('facilities.create');
        Route::post('/facilities', [ComingSoonController::class, 'facilitiesStore'])->name('facilities.store');
        Route::get('/facilities/{id}', [ComingSoonController::class, 'facilitiesShow'])->name('facilities.show');
        Route::get('/facilities/{id}/edit', [ComingSoonController::class, 'facilitiesEdit'])->name('facilities.edit');
        Route::put('/facilities/{id}', [ComingSoonController::class, 'facilitiesUpdate'])->name('facilities.update');
        Route::delete('/facilities/{id}', [ComingSoonController::class, 'facilitiesDestroy'])->name('facilities.destroy');
        
        Route::get('/statistics', [ComingSoonController::class, 'statistics'])->name('statistics.index');
        Route::get('/statistics/create', [ComingSoonController::class, 'statisticsCreate'])->name('statistics.create');
        Route::post('/statistics', [ComingSoonController::class, 'statisticsStore'])->name('statistics.store');
        Route::get('/statistics/{id}', [ComingSoonController::class, 'statisticsShow'])->name('statistics.show');
        Route::get('/statistics/{id}/edit', [ComingSoonController::class, 'statisticsEdit'])->name('statistics.edit');
        Route::put('/statistics/{id}', [ComingSoonController::class, 'statisticsUpdate'])->name('statistics.update');
        Route::delete('/statistics/{id}', [ComingSoonController::class, 'statisticsDestroy'])->name('statistics.destroy');
        
        Route::get('/officials', [ComingSoonController::class, 'officials'])->name('officials.index');
        Route::get('/officials/create', [ComingSoonController::class, 'officialsCreate'])->name('officials.create');
        Route::post('/officials', [ComingSoonController::class, 'officialsStore'])->name('officials.store');
        Route::get('/officials/{id}', [ComingSoonController::class, 'officialsShow'])->name('officials.show');
        Route::get('/officials/{id}/edit', [ComingSoonController::class, 'officialsEdit'])->name('officials.edit');
        Route::put('/officials/{id}', [ComingSoonController::class, 'officialsUpdate'])->name('officials.update');
        Route::delete('/officials/{id}', [ComingSoonController::class, 'officialsDestroy'])->name('officials.destroy');
        
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