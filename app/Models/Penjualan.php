<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penjualan extends Model
{
    protected $fillable = [
        'nomor_nota',
        'nama_customer',
        'tanggal_penjualan',
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

    public function details(): HasMany
    {
        return $this->hasMany(PenjualanDetail::class);
    }
}