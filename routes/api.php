<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FireController;


Route::post('/sign', [FireController::class, 'register']);
Route::post('/signin', [FireController::class, 'login']);

