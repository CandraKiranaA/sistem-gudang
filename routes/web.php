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

    // Form import
    Route::get('/barangs/import', [
        BarangController::class,
        'importForm'
    ])->name('barangs.import.form');


    // Proses import
    Route::post('/barangs/import', [
        BarangController::class,
        'import'
    ])->name('barangs.import');


    // Export Excel
    Route::get('/barangs/export', [
        BarangController::class,
        'export'
    ])->name('barangs.export');


    /*
    |--------------------------------------------------------------------------
    | HAPUS BARANG TERPILIH
    |--------------------------------------------------------------------------
    |
    | PENTING:
    | Route ini harus berada SEBELUM Route::resource('barangs', ...)
    |
    */

    Route::delete('/barangs/bulk-delete', [
        BarangController::class,
        'bulkDelete'
    ])->name('barangs.bulkDelete');


    /*
    |--------------------------------------------------------------------------
    | RESOURCE MASTER BARANG
    |--------------------------------------------------------------------------
    |
    | Hanya SATU kali.
    |
    */

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

// Form import barang masuk
Route::get('/barang-masuk/import', [
    BarangMasukController::class,
    'importForm'
])->name('barang-masuk.import.form');


// Proses import barang masuk
Route::post('/barang-masuk/import', [
    BarangMasukController::class,
    'import'
])->name('barang-masuk.import');


// Export barang masuk
Route::get('/barang-masuk/export', [
    BarangMasukController::class,
    'export'
])->name('barang-masuk.export');


// ================================================================
// BULK DELETE BARANG MASUK
// ================================================================

Route::delete('/barang-masuk/bulk-delete', [
    BarangMasukController::class,
    'bulkDelete'
])->name('barang-masuk.bulkDelete');


// Resource barang masuk
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
    | Harus sebelum:
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
    | LAPORAN BARANG
    |--------------------------------------------------------------------------
    */

    Route::get('/laporan/barang', [
        LaporanBarangController::class,
        'index'
    ])->name('laporan.barang.index');


    /*
    |--------------------------------------------------------------------------
    | DOWNLOAD / EXPORT LAPORAN BARANG
    |--------------------------------------------------------------------------
    */

    Route::get('/laporan/barang/download', [
        LaporanBarangController::class,
        'download'
    ])->name('laporan.export.excel');


    /*
    |--------------------------------------------------------------------------
    | DETAIL LAPORAN BARANG
    |--------------------------------------------------------------------------
    */

    Route::get('/laporan/barang/{barang}', [
        LaporanBarangController::class,
        'show'
    ])->name('laporan.barang.show');


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    Route::post('/logout', [
        AuthController::class,
        'logout'
    ])->name('logout');

});
