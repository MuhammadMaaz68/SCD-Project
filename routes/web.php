<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;

// ==== Public BookVerse Pages ====
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/books', [PageController::class, 'books'])->name('books');
Route::get('/books/{id}', [PageController::class, 'bookDetail'])->name('books.detail');
Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// ==== Dashboards ====
Route::view('/user', 'dashboards.user')->name('user.dashboard');
Route::view('/admin', 'dashboards.admin')->name('admin.dashboard');

// ==== Dashboard (Auth Protected) ====
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ==== Profile (Auth Protected) ====
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';