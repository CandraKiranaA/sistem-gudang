<?php

namespace App\Imports;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class BarangMasukImport implements ToCollection, WithHeadingRow
{
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
            | Nama Barang
            |--------------------------------------------------------------------------
            */

            $namaBarang = trim(
                (string) ($row['nama_barang'] ?? '')
            );

            if ($namaBarang === '') {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Cari Barang di Master Barang
            |--------------------------------------------------------------------------
            */

            $barang = Barang::where(
                'nama_barang',
                $namaBarang
            )->first();

            /*
             * Jika nama barang tidak ditemukan,
             * baris dilewati.
             */

            if (!$barang) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Jumlah Koli
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
            | PCS
            |--------------------------------------------------------------------------
            |
            | Menggunakan pcs_per_koli dari MASTER BARANG.
            |
            | Contoh:
            | pcs_per_koli = 20
            | jumlah_koli = 2
            |
            | hasil:
            | 2 x 20 = 40 PCS
            |
            */

            $pcsPerKoli = (int) (
                $barang->pcs_per_koli ?? 1
            );

            $jumlahPcs = $jumlahKoli * $pcsPerKoli;


            /*
            |--------------------------------------------------------------------------
            | Tanggal Excel
            |--------------------------------------------------------------------------
            */

            $tanggalInput = $this->parseTanggalExcel(
                $row['tanggal_input'] ?? null
            );


            /*
            |--------------------------------------------------------------------------
            | Edisi
            |--------------------------------------------------------------------------
            */

            $edisi = trim(
                (string) ($row['edisi'] ?? '')
            );

            if ($edisi === '') {
                $edisi = null;
            }


            /*
            |--------------------------------------------------------------------------
            | Simpan
            |--------------------------------------------------------------------------
            */

            BarangMasuk::create([

                'barang_id' =>
                    $barang->id,

                'tanggal_input' =>
                    $tanggalInput,

                'edisi' =>
                    $edisi,

                'jumlah_koli' =>
                    $jumlahKoli,

                'jumlah_pcs' =>
                    $jumlahPcs,

                'harga_beli_koli' =>
                    $this->parseNumber(
                        $row['harga_beli_koli'] ?? 0
                    ),

                'harga_jual_koli' =>
                    $this->parseNumber(
                        $row['harga_jual_koli'] ?? 0
                    ),

                'harga_jual_pcs' =>
                    $this->parseNumber(
                        $row['harga_jual_pcs'] ?? 0
                    ),

            ]);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | PARSE TANGGAL EXCEL
    |--------------------------------------------------------------------------
    */

    private function parseTanggalExcel($value)
    {
        if (
            $value === null ||
            $value === ''
        ) {
            return now();
        }

        try {

            /*
             * Excel menyimpan tanggal sebagai angka serial.
             */

            if (is_numeric($value)) {

                return Carbon::instance(
                    ExcelDate::excelToDateTimeObject(
                        $value
                    )
                );
            }


            /*
             * Jika sudah berupa DateTime
             */

            if ($value instanceof \DateTimeInterface) {

                return Carbon::instance(
                    $value
                );
            }


            /*
             * Jika berupa string
             */

            return Carbon::parse(
                trim((string) $value)
            );

        } catch (\Throwable $e) {

            /*
             * Jika tanggal tidak valid,
             * gunakan tanggal sekarang.
             */

            return now();
        }
    }


    /*
    |--------------------------------------------------------------------------
    | PARSE ANGKA / HARGA
    |--------------------------------------------------------------------------
    */

    private function parseNumber($value)
    {
        if (
            $value === null ||
            $value === ''
        ) {
            return 0;
        }


        /*
         * Kalau Excel sudah memberikan angka,
         * langsung gunakan.
         */

        if (is_numeric($value)) {
            return (float) $value;
        }


        /*
         * Bersihkan format Rupiah.
         */

        $value = trim((string) $value);

        $value = str_replace(
            ['Rp', 'rp', ' '],
            '',
            $value
        );


        /*
         * Format Indonesia:
         *
         * 70.000
         * 1.200.000
         */

        if (
            str_contains($value, '.') &&
            !str_contains($value, ',')
        ) {

            $value = str_replace(
                '.',
                '',
                $value
            );

        }


        /*
         * Format:
         *
         * 70.000,50
         */

        elseif (
            str_contains($value, '.') &&
            str_contains($value, ',')
        ) {

            $value = str_replace(
                '.',
                '',
                $value
            );

            $value = str_replace(
                ',',
                '.',
                $value
            );

        }


        /*
         * Format:
         *
         * 70000,50
         */

        elseif (
            str_contains($value, ',')
        ) {

            $value = str_replace(
                ',',
                '.',
                $value
            );
        }


        return (float) $value;
    }
}