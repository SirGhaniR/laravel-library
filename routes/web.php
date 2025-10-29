<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('index');
});

Route::apiResource('home', HomeController::class);

Route::prefix('/admin')->group(function () {
  Route::apiResource('book', BookController::class);
  Route::apiResource('category', CategoryController::class);
});
