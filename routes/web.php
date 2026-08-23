<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/change-password', [PasswordController::class, 'showChangePassword']);

    Route::post('/change-password', [PasswordController::class, 'updatePassword']);

    Route::post('/logout', [AuthController::class, 'logout']);
});

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;

Route::get('/', function () {
    return redirect()->route('barang-masuk.index');
});

Route::resource('barangs', BarangController::class);

Route::resource('barang-masuk', BarangMasukController::class);