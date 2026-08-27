<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanBarang extends Model
{
    /**
     * Laporan barang merupakan data hasil perhitungan,
     * bukan tabel transaksi.
     *
     * Model ini disiapkan sebagai representasi laporan.
     */

    protected $table = 'barangs';

    public $timestamps = false;
}