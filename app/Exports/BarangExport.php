<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BarangExport implements FromCollection, WithHeadings
{
    /**
     * Data yang akan diexport
     */
    public function collection()
    {
        return Barang::select(
            'nama_barang',
            'satuan',
            'jumlah_koli',
            'pcs_per_koli'
        )->get();
    }

    /**
     * Header Excel
     */
    public function headings(): array
    {
        return [
            'nama_barang',
            'satuan',
            'jumlah_koli',
            'pcs_per_koli',
        ];
    }
}