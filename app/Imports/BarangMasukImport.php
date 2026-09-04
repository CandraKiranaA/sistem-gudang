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
    /**
     * =========================================================
     * IMPORT BARANG MASUK DARI EXCEL
     * =========================================================
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            /*
            |--------------------------------------------------------------------------
            | NORMALISASI DATA BARIS
            |--------------------------------------------------------------------------
            */

            $namaBarang = trim(
                (string) ($row['nama_barang'] ?? '')
            );

            $tanggalInput = $row['tanggal_input'] ?? null;

            $jumlahKoliExcel = $row['jumlah_koli'] ?? null;

            /*
            |--------------------------------------------------------------------------
            | LEWATI BARIS KOSONG
            |--------------------------------------------------------------------------
            */

            if (
                $namaBarang === '' &&
                empty($tanggalInput) &&
                empty($jumlahKoliExcel)
            ) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | NAMA BARANG WAJIB ADA
            |--------------------------------------------------------------------------
            */

            if ($namaBarang === '') {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | CARI BARANG YANG SUDAH ADA
            |--------------------------------------------------------------------------
            |
            | PENTING:
            | Jangan membuat Barang baru di sini.
            |
            | Kalau nama barang sudah ada, gunakan ID barang yang sudah ada.
            |
            */

            $barang = Barang::query()
                ->whereRaw(
                    'LOWER(TRIM(nama_barang)) = ?',
                    [mb_strtolower($namaBarang)]
                )
                ->orderBy('id', 'asc')
                ->first();

            /*
            |--------------------------------------------------------------------------
            | JIKA BARANG TIDAK DITEMUKAN
            |--------------------------------------------------------------------------
            |
            | Import Barang Masuk hanya memasukkan transaksi barang masuk.
            | Jadi kalau barang belum ada di Master Barang, baris dilewati.
            |
            */

            if (!$barang) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | PCS PER KOLI
            |--------------------------------------------------------------------------
            */

            $pcsPerKoli = (int) (
                $barang->pcs_per_koli ?? 1
            );

            if ($pcsPerKoli < 1) {
                $pcsPerKoli = 1;
            }

            /*
            |--------------------------------------------------------------------------
            | JUMLAH KOLI
            |--------------------------------------------------------------------------
            */

            $jumlahKoli = (int) (
                $jumlahKoliExcel ?? 0
            );

            if ($jumlahKoli < 1) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | JUMLAH PCS
            |--------------------------------------------------------------------------
            |
            | Kalau Excel memiliki jumlah_pcs dan nilainya valid,
            | gunakan nilai Excel.
            |
            | Kalau kosong/0:
            |
            | PCS = KOLI × PCS PER KOLI
            |
            */

            $jumlahPcsExcel = $row['jumlah_pcs'] ?? null;

            if (
                $jumlahPcsExcel !== null &&
                $jumlahPcsExcel !== '' &&
                (int) $jumlahPcsExcel > 0
            ) {
                $jumlahPcs = (int) $jumlahPcsExcel;
            } else {
                $jumlahPcs =
                    $jumlahKoli *
                    $pcsPerKoli;
            }

            /*
            |--------------------------------------------------------------------------
            | TANGGAL INPUT
            |--------------------------------------------------------------------------
            */

            $tanggal = $this->parseTanggal(
                $tanggalInput
            );

            /*
            |--------------------------------------------------------------------------
            | EDISI
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
            | HARGA
            |--------------------------------------------------------------------------
            */

            $hargaBeliKoli =
                $this->parseNumber(
                    $row['harga_beli_koli'] ?? 0
                );

            $hargaJualKoli =
                $this->parseNumber(
                    $row['harga_jual_koli'] ?? 0
                );

            $hargaJualPcs =
                $this->parseNumber(
                    $row['harga_jual_pcs'] ?? 0
                );

            /*
            |--------------------------------------------------------------------------
            | SIMPAN BARANG MASUK
            |--------------------------------------------------------------------------
            */

            BarangMasuk::create([

                'barang_id' =>
                    $barang->id,

                'tanggal_input' =>
                    $tanggal,

                'edisi' =>
                    $edisi,

                'jumlah_koli' =>
                    $jumlahKoli,

                'jumlah_pcs' =>
                    $jumlahPcs,

                'harga_beli_koli' =>
                    $hargaBeliKoli,

                'harga_jual_koli' =>
                    $hargaJualKoli,

                'harga_jual_pcs' =>
                    $hargaJualPcs,
            ]);
        }
    }


    /**
     * =========================================================
     * PARSE TANGGAL EXCEL
     * =========================================================
     */
    private function parseTanggal($value)
    {
        /*
        |--------------------------------------------------------------------------
        | KOSONG
        |--------------------------------------------------------------------------
        */

        if (
            $value === null ||
            $value === ''
        ) {
            return now();
        }

        /*
        |--------------------------------------------------------------------------
        | JIKA MERUPAKAN ANGKA SERIAL EXCEL
        |--------------------------------------------------------------------------
        */

        if (
            is_numeric($value) &&
            (float) $value > 0
        ) {
            try {

                return ExcelDate::excelToDateTimeObject(
                    $value
                );

            } catch (\Throwable $e) {
                // lanjut ke parser biasa
            }
        }

        /*
        |--------------------------------------------------------------------------
        | FORMAT TANGGAL BIASA
        |--------------------------------------------------------------------------
        */

        try {

            return Carbon::parse($value);

        } catch (\Throwable $e) {

            return now();
        }
    }


    /**
     * =========================================================
     * PARSE ANGKA / HARGA
     * =========================================================
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
        |--------------------------------------------------------------------------
        | JIKA SUDAH NUMERIC
        |--------------------------------------------------------------------------
        */

        if (is_numeric($value)) {
            return (float) $value;
        }

        /*
        |--------------------------------------------------------------------------
        | BERSIHKAN FORMAT RP / TITIK / KOMA
        |--------------------------------------------------------------------------
        */

        $value = trim(
            (string) $value
        );

        $value = str_ireplace(
            ['Rp', 'IDR', ' '],
            '',
            $value
        );

        /*
        |--------------------------------------------------------------------------
        | FORMAT INDONESIA
        |
        | Contoh:
        | 70.000
        | 70.000,50
        |--------------------------------------------------------------------------
        */

        if (
            str_contains($value, ',') &&
            str_contains($value, '.')
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

        } elseif (
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