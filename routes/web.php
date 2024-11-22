<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
