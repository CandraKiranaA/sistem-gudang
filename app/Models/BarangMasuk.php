<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = 'barang_masuks';

    protected $fillable = [
        'tanggal_input',
        'barang_id',
        'jumlah_koli',
        'jumlah_pcs',
        'harga_beli_koli',
        'harga_jual_koli',
        'harga_jual_pcs',
    ];

    protected $casts = [
        'tanggal_input' => 'date',
        'jumlah_koli' => 'integer',
        'jumlah_pcs' => 'integer',
        'harga_beli_koli' => 'decimal:2',
        'harga_jual_koli' => 'decimal:2',
        'harga_jual_pcs' => 'decimal:2',
    ];

    public function barang()
    {
        return $this->belongsTo(
            Barang::class,
            'barang_id'
        );
    }
}