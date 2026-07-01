<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WatchlistController;
use Illuminate\Support\Facades\Route;

// ============================================================
// ROUTES AUTENTIKASI (tamu)
// ============================================================
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth.user')
    ->name('logout');

// ============================================================
// ROUTES PUBLIC (guest, user, admin bisa akses)
// ============================================================
Route::get('/',          [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');

// ============================================================
// ROUTES USER (harus login)
// ============================================================
Route::middleware('auth.user')->group(function () {
    // Watchlist
    Route::get('/watchlist',           [WatchlistController::class, 'index'])->name('watchlist.index');
    Route::post('/watchlist',          [WatchlistController::class, 'store'])->name('watchlist.store');
    Route::delete('/watchlist/{id}',   [WatchlistController::class, 'destroy'])->name('watchlist.destroy');

    // Review
    Route::post('/reviews',            [ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/reviews/{id}',        [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{id}',     [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// ============================================================
// ROUTES ADMIN (harus login + role admin)
// ============================================================
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/',        [AdminController::class, 'dashboard'])->name('dashboard');

    // Pantau review
    Route::get('/reviews', [AdminController::class, 'reviews'])->name('reviews.index');
    Route::delete('/reviews/{id}', [ReviewController::class, 'adminDestroy'])->name('reviews.destroy');

    // Genre CRUD
    Route::get('/genres',          [GenreController::class, 'index'])->name('genres.index');
    Route::post('/genres',         [GenreController::class, 'store'])->name('genres.store');
    Route::get('/genres/{id}/edit',[GenreController::class, 'edit'])->name('genres.edit');
    Route::put('/genres/{id}',     [GenreController::class, 'update'])->name('genres.update');
    Route::delete('/genres/{id}',  [GenreController::class, 'destroy'])->name('genres.destroy');

    // Movie CRUD
    Route::get('/movies',           [MovieController::class, 'adminIndex'])->name('movies.index');
    Route::get('/movies/create',    [MovieController::class, 'create'])->name('movies.create');
    Route::post('/movies',          [MovieController::class, 'store'])->name('movies.store');
    Route::get('/movies/{id}/edit', [MovieController::class, 'edit'])->name('movies.edit');
    Route::put('/movies/{id}',      [MovieController::class, 'update'])->name('movies.update');
    Route::delete('/movies/{id}',   [MovieController::class, 'destroy'])->name('movies.destroy');
});
