<?php

use App\Http\Controllers\API\BookServiceController;
use App\Http\Controllers\API\CategoryServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('book', BookServiceController::class);
Route::apiResource('category', CategoryServiceController::class);
