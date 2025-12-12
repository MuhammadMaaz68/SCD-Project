<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\Auth\GoogleController;


// ==== Public Pages ====
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/books', [PageController::class, 'books'])->name('books.list'); // Renamed to avoid name conflict with resource
Route::get('/books/{book}', [PageController::class, 'bookDetail'])->name('books.detail');
Route::get('/cart', [PageController::class, 'cart'])->name('cart');
Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// ==== Admin Routes (Authenticated) ====
// Prefix 'admin' and name 'admin.' for all grouped routes?
// But user requirements implied specific paths. The plan said "admin/books".
// I will use Resource Controllers.

Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Books CRUD
    Route::resource('books', BookController::class);
    // Categories CRUD
    Route::resource('categories', CategoryController::class);
    
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/borrows/{id}/status', [BorrowController::class, 'updateStatus'])->name('borrows.updateStatus');
});

// ==== Dashboard / Authentication ====
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/user/dashboard', [DashboardController::class, 'userDashboard'])->middleware(['auth', 'verified'])->name('user.dashboard');
Route::post('/borrows', [BorrowController::class, 'store'])->middleware(['auth'])->name('borrows.store');
Route::post('/borrows/{id}/return', [BorrowController::class, 'returnBook'])->middleware(['auth'])->name('borrows.return');
Route::resource('wishlist', \App\Http\Controllers\WishlistController::class)->middleware(['auth']);

// ==== Profile ====
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==== Google Routes ====
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])
->name('auth.google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])
->name('auth.google.callback');

require __DIR__.'/auth.php';