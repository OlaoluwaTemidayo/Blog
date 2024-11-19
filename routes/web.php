<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth; // Ensure Auth facade is imported

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::resource('posts', PostController::class)->except(['index']);

// Authentication Routes
Auth::routes(); // Generates routes for login, registration, password reset, etc.

// Redirect to Home for Authenticated Users
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

// Admin Routes (Protected by auth and isAdmin middleware)
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});
