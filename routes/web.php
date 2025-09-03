<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ContactController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

// Home & Main Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [PageController::class, 'profil'])->name('profil');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');

// Posts & News Routes
Route::prefix('berita')->name('posts.')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/{post:slug}', [PostController::class, 'show'])->name('show');
});

// Other frontend routes (placeholder)
Route::get('/galeri', function() {
    return view('frontend.galleries.index', ['galleries' => collect(), 'categories' => collect()]);
})->name('galleries.index');

Route::get('/download', function() {
    return view('frontend.downloads.index', ['downloads' => collect(), 'categories' => collect()]);
})->name('downloads.index');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// Login Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    $credentials = request()->only('email', 'password');
    
    if (auth()->attempt($credentials)) {
        if (auth()->user()->canManageContent()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('home');
    }
    
    return back()->withErrors(['email' => 'Invalid credentials']);
})->name('login.post');

Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Redirect
|--------------------------------------------------------------------------
*/

Route::get('/admin', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }
    
    if (!auth()->user()->canManageContent()) {
        abort(403, 'Access denied');
    }
    
    return redirect()->route('admin.dashboard');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/admin.php';