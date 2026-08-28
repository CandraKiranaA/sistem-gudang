<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use Illuminate\Http\Request;

class LaporanBarangController extends Controller
{
    /**
     * =========================================================
     * LAPORAN BARANG
     * =========================================================
     */
    public function index(Request $request)
    {
        $search = $request->search;


        /*
        |--------------------------------------------------------------------------
        | DATA BARANG
        |--------------------------------------------------------------------------
        */

        $barangs = Barang::query()

            ->when($search, function ($query) use ($search) {

                $query->where(
                    'nama_barang',
                    'like',
                    '%' . $search . '%'
                );

            })

            ->orderBy('nama_barang')

            ->get();


        /*
        |--------------------------------------------------------------------------
        | LAPORAN STOK BARANG
        |--------------------------------------------------------------------------
        */

        $laporan = $barangs->map(function ($barang) {


            /*
            |--------------------------------------------------------------------------
            | BARANG MASUK
            |--------------------------------------------------------------------------
            */

            $barangMasukKoli = BarangMasuk::where(
                'barang_id',
                $barang->id
            )->sum('jumlah_koli');


            $barangMasukPcs = BarangMasuk::where(
                'barang_id',
                $barang->id
            )->sum('jumlah_pcs');


            /*
            |--------------------------------------------------------------------------
            | BARANG KELUAR
            |--------------------------------------------------------------------------
            */

            $barangKeluarKoli = PenjualanDetail::where(
                'barang_id',
                $barang->id
            )->sum('jumlah_koli');


            $barangKeluarPcs = PenjualanDetail::where(
                'barang_id',
                $barang->id
            )->sum('jumlah_pcs');


            return [

                'id' => $barang->id,

                'nama_barang' =>
                    $barang->nama_barang,

                'satuan' =>
                    $barang->satuan,

                'barang_masuk_koli' =>
                    $barangMasukKoli,

                'barang_masuk_pcs' =>
                    $barangMasukPcs,

                'barang_keluar_koli' =>
                    $barangKeluarKoli,

                'barang_keluar_pcs' =>
                    $barangKeluarPcs,

            ];

        });


        /*
        |--------------------------------------------------------------------------
        | DATA BARANG KELUAR / NOTA
        |--------------------------------------------------------------------------
        |
        | Satu detail barang = satu baris.
        | Informasi customer dan total nota diambil dari penjualan.
        |
        */

        $barangKeluar = PenjualanDetail::with([
            'barang',
            'penjualan'
        ])

        ->when($search, function ($query) use ($search) {

            $query->whereHas('barang', function ($q) use ($search) {

                $q->where(
                    'nama_barang',
                    'like',
                    '%' . $search . '%'
                );

            })

            ->orWhereHas('penjualan', function ($q) use ($search) {

                $q->where(
                    'nama_customer',
                    'like',
                    '%' . $search . '%'
                );

            });

        })

        ->orderByDesc('created_at')

        ->get();


        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'laporan.barang.index',
            compact(
                'laporan',
                'barangKeluar',
                'search'
            )
        );
    }


    /**
     * =========================================================
     * DETAIL BARANG
     * =========================================================
     */
    public function show(Barang $barang)
    {
        $penjualanDetails = PenjualanDetail::with([
            'penjualan',
            'barang'
        ])

        ->where(
            'barang_id',
            $barang->id
        )

        ->orderByDesc('created_at')

        ->get();


        return view(
            'laporan.barang.show',
            compact(
                'barang',
                'penjualanDetails'
            )
        );
    }


    /**
     * =========================================================
     * DOWNLOAD CSV
     * =========================================================
     */
    public function download()
    {
        $barangs = Barang::orderBy('nama_barang')->get();

        $barangKeluar = PenjualanDetail::with([
            'barang',
            'penjualan'
        ])

        ->orderByDesc('created_at')

        ->get();


        $filename =
            'laporan-barang-' .
            now()->format('Y-m-d-H-i-s') .
            '.csv';


        $headers = [

            'Content-Type' =>
                'text/csv; charset=UTF-8',

            'Content-Disposition' =>
                'attachment; filename="' .
                $filename .
                '"',

        ];


        return response()->streamDownload(

            function () use (
                $barangs,
                $barangKeluar
            ) {

                $handle =
                    fopen(
                        'php://output',
                        'w'
                    );


                /*
                |--------------------------------------------------------------------------
                | BOM EXCEL
                |--------------------------------------------------------------------------
                */

                fprintf(
                    $handle,
                    chr(0xEF) .
                    chr(0xBB) .
                    chr(0xBF)
                );


                /*
                |--------------------------------------------------------------------------
                | TABEL STOK BARANG
                |--------------------------------------------------------------------------
                */

                fputcsv($handle, [
                    'STOK BARANG'
                ]);

                fputcsv($handle, [

                    'No',
                    'Nama Barang',
                    'Satuan',

                    'Barang Masuk Koli',
                    'Barang Masuk PCS',

                    'Barang Keluar Koli',
                    'Barang Keluar PCS',

                ]);


                foreach ($barangs as $index => $barang) {

                    $masukKoli =
                        BarangMasuk::where(
                            'barang_id',
                            $barang->id
                        )->sum('jumlah_koli');


                    $masukPcs =
                        BarangMasuk::where(
                            'barang_id',
                            $barang->id
                        )->sum('jumlah_pcs');


                    $keluarKoli =
                        PenjualanDetail::where(
                            'barang_id',
                            $barang->id
                        )->sum('jumlah_koli');


                    $keluarPcs =
                        PenjualanDetail::where(
                            'barang_id',
                            $barang->id
                        )->sum('jumlah_pcs');


                    fputcsv($handle, [

                        $index + 1,

                        $barang->nama_barang,

                        $barang->satuan,

                        $masukKoli,

                        $masukPcs,

                        $keluarKoli,

                        $keluarPcs,

                    ]);

                }


                /*
                |--------------------------------------------------------------------------
                | PEMISAH
                |--------------------------------------------------------------------------
                */

                fputcsv($handle, []);

                fputcsv($handle, []);


                /*
                |--------------------------------------------------------------------------
                | TABEL BARANG KELUAR
                |--------------------------------------------------------------------------
                */

                fputcsv($handle, [
                    'BARANG KELUAR'
                ]);


                fputcsv($handle, [

                    'No',
                    'Tanggal Keluar',
                    'Nama Customer',
                    'Barang Keluar',

                    'Koli',
                    'PCS',

                    'Total Harga',
                    'Diskon',
                    'Total Setelah Diskon',

                ]);


                foreach (
                    $barangKeluar
                    as $index => $detail
                ) {

                    $penjualan =
                        $detail->penjualan;


                    fputcsv($handle, [

                        $index + 1,

                        $penjualan?->tanggal_penjualan
                            ?->format('d/m/Y'),

                        $penjualan?->nama_customer,

                        $detail->barang
                            ?->nama_barang,

                        $detail->jumlah_koli,

                        $detail->jumlah_pcs,

                        $penjualan?->total_harga ?? 0,

                        $penjualan?->diskon ?? 0,

                        $penjualan?->total_setelah_diskon ?? 0,

                    ]);

                }


                fclose($handle);

            },

            $filename,

            $headers

        );
    }
}