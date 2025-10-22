<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('welcome');
});

Route::get('/home', [HomeController::class, 'index']);
Route::post('/home', [HomeController::class, 'store']);
Route::get('/category/{id}', [HomeController::class, 'edit']);
Route::put('/category/{id}', [HomeController::class, 'update']);
Route::delete('/category/{id}', [HomeController::class, 'destroy']);
