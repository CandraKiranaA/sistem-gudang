<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\PenjualanController;


/*
|--------------------------------------------------------------------------
| HALAMAN AWAL
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/login', [
    AuthController::class,
    'showLogin'
])->name('login');

Route::post('/login', [
    AuthController::class,
    'login'
]);


/*
|--------------------------------------------------------------------------
| SEMUA HALAMAN YANG HARUS LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | DATA MASTER BARANG
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'barangs',
        BarangController::class
    );


    /*
    |--------------------------------------------------------------------------
    | STOCK IN
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'barang-masuk',
        BarangMasukController::class
    );


    /*
    |--------------------------------------------------------------------------
    | GANTI PASSWORD
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/change-password',
        [PasswordController::class, 'showChangePassword']
    )->name('change-password');

    Route::post(
        '/change-password',
        [PasswordController::class, 'updatePassword']
    )->name('change-password.update');


    /*
    |--------------------------------------------------------------------------
    | STOCK OUT / PENJUALAN
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/stock-out',
        [PenjualanController::class, 'index']
    )->name('penjualan.index');

    Route::get(
        '/stock-out/create',
        [PenjualanController::class, 'create']
    )->name('penjualan.create');

    Route::post(
        '/stock-out',
        [PenjualanController::class, 'store']
    )->name('penjualan.store');

    Route::get(
        '/stock-out/{penjualan}',
        [PenjualanController::class, 'show']
    )->name('penjualan.show');

    /*
    |--------------------------------------------------------------------------
    | CEK STOK BARANG
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/stock-out/stok/{barang}',
        [PenjualanController::class, 'stok']
    )->name('penjualan.stok');


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/logout',
        [AuthController::class, 'logout']
    )->name('logout');

});