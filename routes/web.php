<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\TabunganController;
use App\Http\Controllers\PengajuanController;

// DASHBOARD
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// LOGIN
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login']); // Handle login
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// REGISTRATION
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register'); // Show registration form
Route::post('register', [AuthController::class, 'register']); // Handle registration

// PASSWORD RESET
Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot.password'); // Show forgot password form
Route::post('forgot-password', [AuthController::class, 'forgotPassword']); // Handle password reset

// PAGES
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi');
Route::get('/pinjaman', [PinjamanController::class, 'pinjaman'])->name('pinjaman');
Route::get('/simpanan', [SimpananController::class, 'simpanan'])->name('simpanan');
Route::get('/tabungan-qurban', [TabunganController::class, 'tabunganQurban'])->name('tabungan-qurban');
Route::get('/pengajuan', [PengajuanController::class, 'pengajuan'])->name('pengajuan');


// PROFILE
Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.view');

//PAGES NEWS 
Route::get('/news1', function () {
    return view('news.detail1');
});

Route::get('/news2', function () {
    return view('news.detail2');
});

Route::get('/news3', function () {
    return view('news.detail3');
});

Route::get('/news4', function () {
    return view('news.detail4');
});



