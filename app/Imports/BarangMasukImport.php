<?php

namespace App\Imports;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BarangMasukImport implements ToCollection, WithHeadingRow
{
    /**
     * Import data barang masuk dari Excel
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            /*
            |--------------------------------------------------------------------------
            | Lewati baris kosong
            |--------------------------------------------------------------------------
            */

            if (
                empty($row['nama_barang']) &&
                empty($row['tanggal_input']) &&
                empty($row['jumlah_koli'])
            ) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Cari barang berdasarkan nama
            |--------------------------------------------------------------------------
            */

            $namaBarang = trim(
                (string) ($row['nama_barang'] ?? '')
            );

            $barang = Barang::where(
                'nama_barang',
                $namaBarang
            )->first();


            /*
            |--------------------------------------------------------------------------
            | Kalau barang tidak ditemukan, lewati baris
            |--------------------------------------------------------------------------
            */

            if (!$barang) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Jumlah koli
            |--------------------------------------------------------------------------
            */

            $jumlahKoli = (int) (
                $row['jumlah_koli'] ?? 0
            );


            if ($jumlahKoli < 1) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | PCS per koli diambil dari Master Barang
            |--------------------------------------------------------------------------
            */

            $pcsPerKoli = (int) (
                $barang->pcs_per_koli ?? 1
            );


            /*
            |--------------------------------------------------------------------------
            | Hitung jumlah PCS otomatis
            |--------------------------------------------------------------------------
            */

            $jumlahPcs = $jumlahKoli * $pcsPerKoli;


            /*
            |--------------------------------------------------------------------------
            | Tanggal input
            |--------------------------------------------------------------------------
            */

            $tanggalInput = $row['tanggal_input'] ?? now()->format('Y-m-d');


            /*
            |--------------------------------------------------------------------------
            | Simpan Barang Masuk
            |--------------------------------------------------------------------------
            */

            BarangMasuk::create([

                'barang_id' => $barang->id,

                'tanggal_input' => $tanggalInput,

                'jumlah_koli' => $jumlahKoli,

                'jumlah_pcs' => $jumlahPcs,

                'harga_beli_koli' => (float) (
                    $row['harga_beli_koli'] ?? 0
                ),

                'harga_jual_koli' => (float) (
                    $row['harga_jual_koli'] ?? 0
                ),

                'harga_jual_pcs' => (float) (
                    $row['harga_jual_pcs'] ?? 0
                ),

            ]);
        }
    }
}