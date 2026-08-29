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
        'total',
        'diskon',
        'bayar_cash',
        'hutang',
    ];

    protected $casts = [
        'tanggal_penjualan' => 'datetime',
        'total' => 'decimal:2',
        'diskon' => 'decimal:2',
        'bayar_cash' => 'decimal:2',
        'hutang' => 'decimal:2',
    ];

    public function details()
    {
        return $this->hasMany(
            PenjualanDetail::class,
            'penjualan_id'
        );
    }
}