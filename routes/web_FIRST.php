<?php

// use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


// DASHBOARD
use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// LOGIN
use App\Http\Controllers\AuthController;

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot.password');
Route::get('register', [AuthController::class, 'register'])->name('register');
