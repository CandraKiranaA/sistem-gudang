<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model
{
    use HasFactory;

    protected $table = 'penjualan_details';


    protected $fillable = [

        'penjualan_id',

        'barang_id',

        'jumlah_koli',

        'jumlah_pcs',

        'harga',

        'subtotal',

    ];


    protected $casts = [

        'jumlah_koli' =>
            'integer',

        'jumlah_pcs' =>
            'integer',

        'harga' =>
            'decimal:2',

        'subtotal' =>
            'decimal:2',

    ];


   public function penjualan()
{
    return $this->belongsTo(Penjualan::class, 'penjualan_id');
}


    public function barang()
    {
        return $this->belongsTo(
            Barang::class,
            'barang_id'
        );
    }
}