<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs';

    protected $fillable = [
        'nama_barang',
        'satuan',
        'jumlah_koli',
        'pcs_per_koli',
    ];

    protected $casts = [
        'jumlah_koli' => 'integer',
        'pcs_per_koli' => 'integer',
    ];

    public function penjualanDetails()
    {
        return $this->hasMany(PenjualanDetail::class);
    }

    public function barangMasuks()
    {
        return $this->hasMany(
            BarangMasuk::class,
            'barang_id'
        );
    }
}