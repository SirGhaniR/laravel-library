<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('index');
});

Route::apiResource('category', CategoryController::class);

Route::apiResource('book',  BookController::class);
