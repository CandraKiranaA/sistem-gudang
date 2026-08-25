<?php

namespace App\Imports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BarangImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Barang([
            'nama_barang' => trim($row['nama_barang'] ?? ''),
            'satuan' => trim($row['satuan'] ?? ''),
            'jumlah_koli' => (int) ($row['jumlah_koli'] ?? 1),
            'pcs_per_koli' => (int) ($row['pcs_per_koli'] ?? 1),
        ]);
    }
}