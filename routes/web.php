<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\CustomerController;


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

    // Form import Excel
    Route::get(
        '/barangs/import',
        [BarangController::class, 'importForm']
    )->name('barangs.import.form');

    // Proses import Excel
    Route::post(
        '/barangs/import',
        [BarangController::class, 'import']
    )->name('barangs.import');

    // Export Excel
    Route::get(
        '/barangs/export',
        [BarangController::class, 'export']
    )->name('barangs.export');

    // CRUD Barang
    Route::resource(
        'barangs',
        BarangController::class
    )->except([
        'show'
    ]);


    /*
    |--------------------------------------------------------------------------
    | BARANG MASUK
    |--------------------------------------------------------------------------
    */

    // Form import Excel Barang Masuk
    Route::get(
        '/barang-masuk/import',
        [BarangMasukController::class, 'importForm']
    )->name('barang-masuk.import.form');

    // Proses import Excel Barang Masuk
    Route::post(
        '/barang-masuk/import',
        [BarangMasukController::class, 'import']
    )->name('barang-masuk.import');

    // Export Excel Barang Masuk
    Route::get(
        '/barang-masuk/export',
        [BarangMasukController::class, 'export']
    )->name('barang-masuk.export');

    // CRUD Barang Masuk
    Route::resource(
        'barang-masuk',
        BarangMasukController::class
    );


    /*
    |--------------------------------------------------------------------------
    | CUSTOMERS
    |--------------------------------------------------------------------------
    */

    // CRUD Customer
    Route::resource(
        'customers',
        CustomerController::class
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

    // Daftar penjualan
    Route::get(
        '/stock-out',
        [PenjualanController::class, 'index']
    )->name('penjualan.index');

    // Form penjualan
    Route::get(
        '/stock-out/create',
        [PenjualanController::class, 'create']
    )->name('penjualan.create');

    // Simpan penjualan
    Route::post(
        '/stock-out',
        [PenjualanController::class, 'store']
    )->name('penjualan.store');

    // Detail penjualan
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