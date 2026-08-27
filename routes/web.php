<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LaporanBarangController;


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

        // Total jenis barang
        $totalBarang = \App\Models\Barang::count();


        // Total koli barang masuk
        $totalBarangMasuk =
            \App\Models\BarangMasuk::sum('jumlah_koli');


        // Total barang keluar
        $totalBarangKeluar =
            \App\Models\PenjualanDetail::sum('jumlah_pcs');


        // Total nota penjualan
        $totalNota =
            \App\Models\Penjualan::count();


        // Total customer unik
        $totalCustomer =
            \App\Models\Penjualan::whereNotNull('nama_customer')
                ->where('nama_customer', '!=', '')
                ->distinct()
                ->count('nama_customer');


        return view('dashboard', compact(
            'totalBarang',
            'totalBarangMasuk',
            'totalBarangKeluar',
            'totalNota',
            'totalCustomer'
        ));

    })->name('dashboard');



    /*
    |--------------------------------------------------------------------------
    | MASTER BARANG
    |--------------------------------------------------------------------------
    */


    Route::get('/barangs/import', [
        BarangController::class,
        'importForm'
    ])->name('barangs.import.form');


    Route::post('/barangs/import', [
        BarangController::class,
        'import'
    ])->name('barangs.import');


    Route::get('/barangs/export', [
        BarangController::class,
        'export'
    ])->name('barangs.export');


    Route::resource('barangs', BarangController::class)
        ->except(['show']);



    /*
    |--------------------------------------------------------------------------
    | BARANG MASUK
    |--------------------------------------------------------------------------
    */


    Route::get('/barang-masuk/import', [
        BarangMasukController::class,
        'importForm'
    ])->name('barang-masuk.import.form');


    Route::post('/barang-masuk/import', [
        BarangMasukController::class,
        'import'
    ])->name('barang-masuk.import');


    Route::get('/barang-masuk/export', [
        BarangMasukController::class,
        'export'
    ])->name('barang-masuk.export');


    Route::resource(
        'barang-masuk',
        BarangMasukController::class
    );



    /*
    |--------------------------------------------------------------------------
    | CUSTOMER
    |--------------------------------------------------------------------------
    |
    | Data customer diambil dari:
    | penjualans.nama_customer
    |
    */


    /*
    |--------------------------------------------------------------------------
    | DAFTAR CUSTOMER
    |--------------------------------------------------------------------------
    */

    Route::get('/customers', [
        CustomerController::class,
        'index'
    ])->name('customers.index');


    /*
    |--------------------------------------------------------------------------
    | DETAIL CUSTOMER
    |--------------------------------------------------------------------------
    */

    Route::get('/customers/{nama_customer}', [
        CustomerController::class,
        'show'
    ])
        ->where('nama_customer', '.*')
        ->name('customers.show');



    /*
    |--------------------------------------------------------------------------
    | STOCK OUT / PENJUALAN
    |--------------------------------------------------------------------------
    */


    /*
    |--------------------------------------------------------------------------
    | DAFTAR STOCK OUT
    |--------------------------------------------------------------------------
    */

    Route::get('/stock-out', [
        PenjualanController::class,
        'index'
    ])->name('penjualan.index');



    /*
    |--------------------------------------------------------------------------
    | FORM BUAT NOTA
    |--------------------------------------------------------------------------
    */

    Route::get('/stock-out/create', [
        PenjualanController::class,
        'create'
    ])->name('penjualan.create');



    /*
    |--------------------------------------------------------------------------
    | SIMPAN STOCK OUT
    |--------------------------------------------------------------------------
    */

    Route::post('/stock-out', [
        PenjualanController::class,
        'store'
    ])->name('penjualan.store');



    /*
    |--------------------------------------------------------------------------
    | CEK STOK
    |--------------------------------------------------------------------------
    |
    | Route ini harus diletakkan sebelum:
    | /stock-out/{penjualan}
    |
    */

    Route::get('/stock-out/stok/{barang}', [
        PenjualanController::class,
        'stok'
    ])->name('penjualan.stok');



    /*
    |--------------------------------------------------------------------------
    | DETAIL NOTA
    |--------------------------------------------------------------------------
    */

    Route::get('/stock-out/{penjualan}', [
        PenjualanController::class,
        'show'
    ])->name('penjualan.show');



    /*
    |--------------------------------------------------------------------------
    | HAPUS NOTA
    |--------------------------------------------------------------------------
    */

    Route::delete('/stock-out/{penjualan}', [
        PenjualanController::class,
        'destroy'
    ])->name('penjualan.destroy');



    /*
    |--------------------------------------------------------------------------
    | GANTI PASSWORD
    |--------------------------------------------------------------------------
    */

    Route::get('/change-password', [
        PasswordController::class,
        'showChangePassword'
    ])->name('change-password');


    Route::post('/change-password', [
        PasswordController::class,
        'updatePassword'
    ])->name('change-password.update');



    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    Route::post('/logout', [
        AuthController::class,
        'logout'
    ])->name('logout');



    /*
    |--------------------------------------------------------------------------
    | LAPORAN BARANG
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/laporan/barang',
        [LaporanBarangController::class, 'index']
    )->name('laporan.barang.index');


    Route::get(
        '/laporan/barang/{id}',
        [LaporanBarangController::class, 'show']
    )->name('laporan.barang.show');


    Route::get(
        '/laporan/export-excel',
        [LaporanBarangController::class, 'exportExcel']
    )->name('laporan.export.excel');

});