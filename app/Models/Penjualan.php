<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualans';

    protected $fillable = [

        'nomor_nota',

        'tanggal_penjualan',

        'nama_customer',

        'total_harga',

        'diskon',

        'total_setelah_diskon',

    ];


    protected $casts = [

        'tanggal_penjualan' => 'date',

        'total_harga' =>
            'decimal:2',

        'diskon' =>
            'decimal:2',

        'total_setelah_diskon' =>
            'decimal:2',

    ];


    public function details()
    {
        return $this->hasMany(
            PenjualanDetail::class,
            'penjualan_id'
        );
    }
}