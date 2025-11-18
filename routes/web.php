<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/auth', [AuthController::class, 'showLogin'])->name('login');
Route::post('/auth', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
  Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
  Route::post('/create-member', [AuthController::class, 'register']);

  // Admin routes - require admin role
  Route::middleware('role:admin')->prefix('/admin')->group(function () {
    Route::apiResource('book', BookController::class);
    Route::apiResource('category', CategoryController::class);
    Route::apiResource('borrow', BorrowController::class);
  });

  // Member routes - read-only access
  Route::middleware('role:member')->prefix('/member')->group(function () {
    Route::get('/books', [BookController::class, 'index'])->name('member.books');
    Route::get('/categories', [CategoryController::class, 'index'])->name('member.categories');
    Route::get('/borrows', [BorrowController::class, 'index'])->name('member.borrows');
  });
});
