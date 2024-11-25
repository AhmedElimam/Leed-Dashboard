<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FireController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::post('/signup', [FireController::class, 'register']);
Route::post('/signin', [FireController::class, 'login']);


Route::apiResource('products', ProductController::class);
Route::apiResource('categories', CategoryController::class);

