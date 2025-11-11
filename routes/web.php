<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::prefix('/admin')->group(function () {
  Route::apiResource('book', BookController::class);
  Route::apiResource('category', CategoryController::class);
  Route::apiResource('borrow', BorrowController::class);
});
