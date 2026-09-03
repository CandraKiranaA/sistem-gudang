<?php

namespace App\Imports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BarangImport implements ToModel, WithHeadingRow
{
    /**
     * Normalisasi nama header Excel
     */
    private function normalizeKey($key)
    {
        $key = strtolower(trim($key));

        // Ganti berbagai karakter menjadi _
        $key = str_replace(
            [' ', '-', '/', '\\', '.', '(', ')'],
            '_',
            $key
        );

        // Hilangkan underscore berulang
        $key = preg_replace('/_+/', '_', $key);

        return trim($key, '_');
    }

    /**
     * Ambil nilai berdasarkan beberapa kemungkinan nama kolom
     */
    private function getValue(array $row, array $keys, $default = null)
    {
        // Normalisasi semua key dari Excel
        $normalizedRow = [];

        foreach ($row as $key => $value) {
            $normalizedKey = $this->normalizeKey($key);

            $normalizedRow[$normalizedKey] = $value;
        }

        // Cari berdasarkan kemungkinan nama kolom
        foreach ($keys as $key) {

            $normalizedKey = $this->normalizeKey($key);

            if (
                array_key_exists($normalizedKey, $normalizedRow)
                && $normalizedRow[$normalizedKey] !== null
                && trim((string) $normalizedRow[$normalizedKey]) !== ''
            ) {
                return $normalizedRow[$normalizedKey];
            }
        }

        return $default;
    }

    /**
     * Proses setiap baris Excel
     */
    public function model(array $row)
    {
        /*
         * ================================
         * NAMA BARANG
         * ================================
         */
        $namaBarang = $this->getValue(
            $row,
            [
                'nama_barang',
                'nama barang',
                'nama',
                'barang',
                'nama produk',
                'nama_produk',
            ]
        );

        /*
         * ================================
         * SATUAN
         * ================================
         */
        $satuan = $this->getValue(
            $row,
            [
                'satuan',
                'unit',
                'satuan barang',
            ],
            'PCS'
        );

        /*
         * ================================
         * JUMLAH KOLI
         * ================================
         */
        $jumlahKoli = $this->getValue(
            $row,
            [
                'jumlah_koli',
                'jumlah koli',
                'koli',
                'qty koli',
                'qty_koli',
            ],
            1
        );

        /*
         * ================================
         * PCS PER KOLI
         * ================================
         */
        $pcsPerKoli = $this->getValue(
            $row,
            [
                'pcs_per_koli',
                'pcs per koli',
                'pcs/koli',
                'pcs koli',
                'isi koli',
                'isi per koli',
                'jumlah pcs',
                'jumlah_pcs',
            ],
            1
        );

        /*
         * ================================
         * JANGAN IMPORT BARIS KOSONG
         * ================================
         */
        if (
            $namaBarang === null ||
            trim((string) $namaBarang) === ''
        ) {
            return null;
        }

        /*
         * Bersihkan angka
         */
        $jumlahKoli = $this->cleanNumber($jumlahKoli);
        $pcsPerKoli = $this->cleanNumber($pcsPerKoli);

        /*
         * Pastikan minimal 1
         */
        if ($jumlahKoli < 1) {
            $jumlahKoli = 1;
        }

        if ($pcsPerKoli < 1) {
            $pcsPerKoli = 1;
        }

        /*
         * ================================
         * SIMPAN BARANG
         * ================================
         */
        return new Barang([
            'nama_barang' => trim((string) $namaBarang),
            'satuan' => trim((string) $satuan),
            'jumlah_koli' => $jumlahKoli,
            'pcs_per_koli' => $pcsPerKoli,
        ]);
    }

    /**
     * Membersihkan format angka dari Excel
     */
    private function cleanNumber($value)
    {
        if ($value === null || $value === '') {
            return 1;
        }

        /*
         * Jika Excel membaca sebagai angka langsung
         */
        if (is_numeric($value)) {
            return (int) $value;
        }

        /*
         * Bersihkan karakter selain angka
         */
        $value = preg_replace('/[^0-9]/', '', (string) $value);

        if ($value === '') {
            return 1;
        }

        return (int) $value;
    }
}