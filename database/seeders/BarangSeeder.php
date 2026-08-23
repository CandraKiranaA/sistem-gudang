<?php
namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        Barang::create([
            'kode_barang' => 'KPS001',
            'nama_barang' => 'Kipas',
            'pcs_per_koli' => 2,
            'satuan' => 'pcs',
        ]);

        Barang::create([
            'kode_barang' => 'LMR001',
            'nama_barang' => 'Lemari',
            'pcs_per_koli' => 1,
            'satuan' => 'pcs',
        ]);

        Barang::create([
            'kode_barang' => 'KRS001',
            'nama_barang' => 'Kursi',
            'pcs_per_koli' => 4,
            'satuan' => 'pcs',
        ]);
    }
}