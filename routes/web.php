<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\firebase;

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);



Route::get("/create",[firebase::class,'show'] );
Route::post('/register', [firebase::class, 'create'])->name('register');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
