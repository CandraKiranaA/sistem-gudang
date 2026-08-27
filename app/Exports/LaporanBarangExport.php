<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanBarangExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Barang::select(
            'nama_barang',
            'satuan',
            'jumlah_koli',
            'pcs_per_koli'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Nama Barang',
            'Satuan',
            'Jumlah Koli',
            'Pcs per Koli',
        ];
    }
}