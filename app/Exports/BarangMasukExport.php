<?php

namespace App\Exports;

use App\Models\BarangMasuk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BarangMasukExport implements FromCollection, WithHeadings
{
    /**
     * Data yang akan diexport
     */
    public function collection()
    {
        return BarangMasuk::with('barang')
            ->latest('tanggal_input')
            ->get()
            ->map(function ($item) {

                return [

                    'tanggal_input' =>
                        $item->tanggal_input,

                    'nama_barang' =>
                        $item->barang->nama_barang ?? '',

                    'satuan' =>
                        $item->barang->satuan ?? '',

                    'pcs_per_koli' =>
                        $item->barang->pcs_per_koli ?? 0,

                    'jumlah_koli' =>
                        $item->jumlah_koli ?? 0,

                    'jumlah_pcs' =>
                        $item->jumlah_pcs ?? 0,

                    'harga_beli_koli' =>
                        $item->harga_beli_koli ?? 0,

                    'harga_jual_koli' =>
                        $item->harga_jual_koli ?? 0,

                    'harga_jual_pcs' =>
                        $item->harga_jual_pcs ?? 0,

                ];
            });
    }


    /**
     * Header Excel
     */
    public function headings(): array
    {
        return [

            'tanggal_input',

            'nama_barang',

            'satuan',

            'pcs_per_koli',

            'jumlah_koli',

            'jumlah_pcs',

            'harga_beli_koli',

            'harga_jual_koli',

            'harga_jual_pcs',

        ];
    }
}