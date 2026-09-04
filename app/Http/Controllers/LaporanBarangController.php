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
     * HALAMAN LAPORAN BARANG
     * =========================================================
     */
    public function index(Request $request)
    {
        $search = trim($request->search ?? '');

        /*
        |--------------------------------------------------------------------------
        | AMBIL SEMUA BARANG
        |--------------------------------------------------------------------------
        */

        $barangs = Barang::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(
                    'nama_barang',
                    'like',
                    '%' . $search . '%'
                );
            })
            ->orderBy('nama_barang', 'asc')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | BUAT LAPORAN SETIAP BARANG
        |--------------------------------------------------------------------------
        */

        $laporan = $barangs->map(function ($barang) {

            /*
            |--------------------------------------------------------------------------
            | BARANG MASUK
            |--------------------------------------------------------------------------
            */

            $barangMasuks = BarangMasuk::query()
                ->where('barang_id', $barang->id)
                ->get();


            $barangMasukKoli = $barangMasuks->sum(function ($item) {
                return (int) ($item->jumlah_koli ?? 0);
            });


            $barangMasukPcs = $barangMasuks->sum(function ($item) {
                return (int) ($item->jumlah_pcs ?? 0);
            });


            /*
            |--------------------------------------------------------------------------
            | BARANG KELUAR
            |--------------------------------------------------------------------------
            */

            $barangKeluarDetails = PenjualanDetail::query()
                ->where('barang_id', $barang->id)
                ->get();


            $barangKeluarKoli = $barangKeluarDetails->sum(function ($item) {
                return (int) ($item->jumlah_koli ?? 0);
            });


            $barangKeluarPcs = $barangKeluarDetails->sum(function ($item) {
                return (int) ($item->jumlah_pcs ?? 0);
            });


            /*
            |--------------------------------------------------------------------------
            | SISA
            |--------------------------------------------------------------------------
            */

            $sisaKoli =
                $barangMasukKoli -
                $barangKeluarKoli;


            $sisaPcs =
                $barangMasukPcs -
                $barangKeluarPcs;


            /*
            |--------------------------------------------------------------------------
            | TOTAL MODAL BARANG MASUK
            |--------------------------------------------------------------------------
            */

            $totalModalMasuk = $barangMasuks->sum(function ($item) {

                $hargaBeliKoli =
                    (float) ($item->harga_beli_koli ?? 0);

                $jumlahKoli =
                    (int) ($item->jumlah_koli ?? 0);

                return $hargaBeliKoli * $jumlahKoli;
            });


            /*
            |--------------------------------------------------------------------------
            | MODAL RATA-RATA PER PCS
            |--------------------------------------------------------------------------
            */

            $modalPerPcs = 0;

            if ($barangMasukPcs > 0) {

                $modalPerPcs =
                    $totalModalMasuk /
                    $barangMasukPcs;
            }


            /*
            |--------------------------------------------------------------------------
            | HITUNG KEUNTUNGAN
            |--------------------------------------------------------------------------
            */

            $keuntungan = 0;


            foreach ($barangKeluarDetails as $detail) {

                $jumlahPcs =
                    (int) ($detail->jumlah_pcs ?? 0);


                $subtotal =
                    (float) ($detail->subtotal ?? 0);


                /*
                |--------------------------------------------------------------------------
                | AMBIL DATA PENJUALAN
                |--------------------------------------------------------------------------
                */

                $penjualan = null;

                if ($detail->penjualan_id) {

                    $penjualan = Penjualan::find(
                        $detail->penjualan_id
                    );
                }


                /*
                |--------------------------------------------------------------------------
                | DISKON NOMINAL
                |--------------------------------------------------------------------------
                */

                $nominalDiskon = 0;

                if ($penjualan) {

                    $nominalDiskon = (float) (
                        $penjualan->getRawOriginal('diskon') ?? 0
                    );
                }


                /*
                |--------------------------------------------------------------------------
                | TOTAL SETELAH DISKON
                |--------------------------------------------------------------------------
                */

                $totalSetelahDiskon =
                    max(
                        0,
                        $subtotal - $nominalDiskon
                    );


                /*
                |--------------------------------------------------------------------------
                | MODAL BARANG TERJUAL
                |--------------------------------------------------------------------------
                */

                $modalTerjual =
                    $jumlahPcs *
                    $modalPerPcs;


                /*
                |--------------------------------------------------------------------------
                | KEUNTUNGAN
                |--------------------------------------------------------------------------
                */

                $keuntungan +=
                    $totalSetelahDiskon -
                    $modalTerjual;
            }


            /*
            |--------------------------------------------------------------------------
            | RETURN DATA
            |--------------------------------------------------------------------------
            */

            return [

                'id' =>
                    $barang->id,

                'nama_barang' =>
                    $barang->nama_barang,

                'satuan' =>
                    $barang->satuan,

                'pcs_per_koli' =>
                    $barang->pcs_per_koli ?? 0,

                'barang_masuk_koli' =>
                    $barangMasukKoli,

                'barang_masuk_pcs' =>
                    $barangMasukPcs,

                'barang_keluar_koli' =>
                    $barangKeluarKoli,

                'barang_keluar_pcs' =>
                    $barangKeluarPcs,

                'sisa_koli' =>
                    $sisaKoli,

                'sisa_pcs' =>
                    $sisaPcs,

                'keuntungan' =>
                    $keuntungan,
            ];
        });


        /*
        |--------------------------------------------------------------------------
        | DATA BARANG KELUAR
        |--------------------------------------------------------------------------
        */

        $barangKeluar = PenjualanDetail::query()
            ->with([
                'barang',
                'penjualan'
            ])
            ->when($search !== '', function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->whereHas('barang', function ($barangQuery) use ($search) {

                        $barangQuery->where(
                            'nama_barang',
                            'like',
                            '%' . $search . '%'
                        );

                    })->orWhereHas('penjualan', function ($penjualanQuery) use ($search) {

                        $penjualanQuery->where(
                            'nama_customer',
                            'like',
                            '%' . $search . '%'
                        );
                    });
                });
            })
            ->orderByDesc('created_at')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | HITUNG DATA DISKON NOMINAL UNTUK BARANG KELUAR
        |--------------------------------------------------------------------------
        */

        foreach ($barangKeluar as $detail) {

            $subtotal =
                (float) ($detail->subtotal ?? 0);


            /*
            |--------------------------------------------------------------------------
            | DISKON NOMINAL
            |--------------------------------------------------------------------------
            */

            $nominalDiskon = 0;

            if ($detail->penjualan) {

                $nominalDiskon = (float) (
                    $detail
                        ->penjualan
                        ->getRawOriginal('diskon')
                    ?? 0
                );
            }


            /*
            |--------------------------------------------------------------------------
            | BATASI DISKON AGAR TIDAK MELEBIHI SUBTOTAL
            |--------------------------------------------------------------------------
            */

            $nominalDiskon =
                min(
                    max(0, $nominalDiskon),
                    $subtotal
                );


            /*
            |--------------------------------------------------------------------------
            | TOTAL SETELAH DISKON
            |--------------------------------------------------------------------------
            */

            $totalSetelahDiskon =
                $subtotal -
                $nominalDiskon;


            /*
            |--------------------------------------------------------------------------
            | DATA UNTUK VIEW
            |--------------------------------------------------------------------------
            */

            $detail->laporan_subtotal =
                $subtotal;


            $detail->laporan_diskon_nominal =
                $nominalDiskon;


            $detail->laporan_total_setelah_diskon =
                $totalSetelahDiskon;
        }


        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'laporan.barang.index',
            [
                'laporan' =>
                    $laporan,

                'barangKeluar' =>
                    $barangKeluar,

                'search' =>
                    $search,
            ]
        );
    }


    /**
     * =========================================================
     * DETAIL BARANG
     * =========================================================
     */
    public function show(Barang $barang)
    {
        /*
        |--------------------------------------------------------------------------
        | BARANG MASUK
        |--------------------------------------------------------------------------
        */

        $barangMasuks = BarangMasuk::query()
            ->where('barang_id', $barang->id)
            ->orderByDesc('tanggal_input')
            ->orderByDesc('created_at')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | TOTAL BARANG MASUK
        |--------------------------------------------------------------------------
        */

        $totalMasukKoli =
            $barangMasuks->sum(function ($item) {
                return (int) ($item->jumlah_koli ?? 0);
            });


        $totalMasukPcs =
            $barangMasuks->sum(function ($item) {
                return (int) ($item->jumlah_pcs ?? 0);
            });


        /*
        |--------------------------------------------------------------------------
        | BARANG KELUAR
        |--------------------------------------------------------------------------
        */

        $penjualanDetails =
            PenjualanDetail::query()
                ->with([
                    'barang',
                    'penjualan'
                ])
                ->where('barang_id', $barang->id)
                ->orderByDesc('created_at')
                ->get();


        /*
        |--------------------------------------------------------------------------
        | TOTAL BARANG KELUAR
        |--------------------------------------------------------------------------
        */

        $totalKeluarKoli =
            $penjualanDetails->sum(function ($item) {
                return (int) ($item->jumlah_koli ?? 0);
            });


        $totalKeluarPcs =
            $penjualanDetails->sum(function ($item) {
                return (int) ($item->jumlah_pcs ?? 0);
            });


        /*
        |--------------------------------------------------------------------------
        | SISA
        |--------------------------------------------------------------------------
        */

        $sisaKoli =
            $totalMasukKoli -
            $totalKeluarKoli;


        $sisaPcs =
            $totalMasukPcs -
            $totalKeluarPcs;


        /*
        |--------------------------------------------------------------------------
        | TOTAL MODAL
        |--------------------------------------------------------------------------
        */

        $totalModalMasuk =
            $barangMasuks->sum(function ($item) {

                $hargaBeli =
                    (float) (
                        $item->harga_beli_koli ?? 0
                    );

                $jumlahKoli =
                    (int) (
                        $item->jumlah_koli ?? 0
                    );

                return $hargaBeli * $jumlahKoli;
            });


        /*
        |--------------------------------------------------------------------------
        | MODAL PER PCS
        |--------------------------------------------------------------------------
        */

        $rataRataModalPcs = 0;

        if ($totalMasukPcs > 0) {

            $rataRataModalPcs =
                $totalModalMasuk /
                $totalMasukPcs;
        }


        /*
        |--------------------------------------------------------------------------
        | KEUNTUNGAN
        |--------------------------------------------------------------------------
        */

        $totalKeuntungan = 0;


        foreach ($penjualanDetails as $detail) {

            $jumlahPcs =
                (int) ($detail->jumlah_pcs ?? 0);


            $subtotal =
                (float) ($detail->subtotal ?? 0);


            /*
            |--------------------------------------------------------------------------
            | DISKON NOMINAL
            |--------------------------------------------------------------------------
            */

            $nominalDiskon = 0;

            if ($detail->penjualan) {

                $nominalDiskon =
                    (float) (
                        $detail
                            ->penjualan
                            ->getRawOriginal('diskon')
                        ?? 0
                    );
            }


            /*
            |--------------------------------------------------------------------------
            | BATASI DISKON
            |--------------------------------------------------------------------------
            */

            $nominalDiskon =
                min(
                    max(0, $nominalDiskon),
                    $subtotal
                );


            /*
            |--------------------------------------------------------------------------
            | TOTAL SETELAH DISKON
            |--------------------------------------------------------------------------
            */

            $totalSetelahDiskon =
                $subtotal -
                $nominalDiskon;


            /*
            |--------------------------------------------------------------------------
            | MODAL BARANG TERJUAL
            |--------------------------------------------------------------------------
            */

            $modalTerjual =
                $jumlahPcs *
                $rataRataModalPcs;


            /*
            |--------------------------------------------------------------------------
            | KEUNTUNGAN
            |--------------------------------------------------------------------------
            */

            $keuntungan =
                $totalSetelahDiskon -
                $modalTerjual;


            /*
            |--------------------------------------------------------------------------
            | DATA UNTUK VIEW
            |--------------------------------------------------------------------------
            */

            $detail->laporan_subtotal =
                $subtotal;


            $detail->laporan_diskon_nominal =
                $nominalDiskon;


            $detail->laporan_total_setelah_diskon =
                $totalSetelahDiskon;


            $detail->laporan_modal =
                $modalTerjual;


            $detail->laporan_keuntungan =
                $keuntungan;


            $totalKeuntungan +=
                $keuntungan;
        }


        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW DETAIL
        |--------------------------------------------------------------------------
        */

        return view(
            'laporan.barang.show',
            compact(
                'barang',
                'barangMasuks',
                'penjualanDetails',
                'totalMasukKoli',
                'totalMasukPcs',
                'totalKeluarKoli',
                'totalKeluarPcs',
                'sisaKoli',
                'sisaPcs',
                'totalKeuntungan',
                'rataRataModalPcs'
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
        $barangs =
            Barang::orderBy('nama_barang')->get();


        $barangKeluar =
            PenjualanDetail::with([
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
                | BOM
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
                | STOK BARANG
                |--------------------------------------------------------------------------
                */

                fputcsv(
                    $handle,
                    ['STOK BARANG']
                );


                fputcsv(
                    $handle,
                    [
                        'No',
                        'Nama Barang',
                        'Satuan',
                        'Barang Masuk Koli',
                        'Barang Masuk PCS',
                        'Barang Keluar Koli',
                        'Barang Keluar PCS',
                        'Sisa Koli',
                        'Sisa PCS',
                        'Keuntungan'
                    ]
                );


                foreach (
                    $barangs
                    as $index => $barang
                ) {

                    $masuks =
                        BarangMasuk::where(
                            'barang_id',
                            $barang->id
                        )->get();


                    $keluars =
                        PenjualanDetail::where(
                            'barang_id',
                            $barang->id
                        )->get();


                    $masukKoli =
                        $masuks->sum(
                            'jumlah_koli'
                        );


                    $masukPcs =
                        $masuks->sum(
                            'jumlah_pcs'
                        );


                    $keluarKoli =
                        $keluars->sum(
                            'jumlah_koli'
                        );


                    $keluarPcs =
                        $keluars->sum(
                            'jumlah_pcs'
                        );


                    $totalModal =
                        $masuks->sum(
                            function ($item) {

                                return
                                    (float) (
                                        $item->harga_beli_koli ?? 0
                                    )
                                    *
                                    (int) (
                                        $item->jumlah_koli ?? 0
                                    );
                            }
                        );


                    $modalPerPcs = 0;


                    if ($masukPcs > 0) {

                        $modalPerPcs =
                            $totalModal /
                            $masukPcs;
                    }


                    $keuntungan = 0;


                    foreach ($keluars as $detail) {

                        $subtotal =
                            (float) (
                                $detail->subtotal ?? 0
                            );


                        $jumlahPcs =
                            (int) (
                                $detail->jumlah_pcs ?? 0
                            );


                        $penjualan =
                            Penjualan::find(
                                $detail->penjualan_id
                            );


                        /*
                        |--------------------------------------------------------------------------
                        | DISKON NOMINAL
                        |--------------------------------------------------------------------------
                        */

                        $nominalDiskon = 0;

                        if ($penjualan) {

                            $nominalDiskon =
                                (float) (
                                    $penjualan
                                        ->getRawOriginal(
                                            'diskon'
                                        )
                                    ?? 0
                                );
                        }


                        /*
                        |--------------------------------------------------------------------------
                        | BATASI DISKON
                        |--------------------------------------------------------------------------
                        */

                        $nominalDiskon =
                            min(
                                max(0, $nominalDiskon),
                                $subtotal
                            );


                        /*
                        |--------------------------------------------------------------------------
                        | TOTAL SETELAH DISKON
                        |--------------------------------------------------------------------------
                        */

                        $bersih =
                            $subtotal -
                            $nominalDiskon;


                        /*
                        |--------------------------------------------------------------------------
                        | MODAL
                        |--------------------------------------------------------------------------
                        */

                        $modal =
                            $jumlahPcs *
                            $modalPerPcs;


                        /*
                        |--------------------------------------------------------------------------
                        | KEUNTUNGAN
                        |--------------------------------------------------------------------------
                        */

                        $keuntungan +=
                            $bersih -
                            $modal;
                    }


                    fputcsv(
                        $handle,
                        [
                            $index + 1,
                            $barang->nama_barang,
                            $barang->satuan,
                            $masukKoli,
                            $masukPcs,
                            $keluarKoli,
                            $keluarPcs,
                            $masukKoli - $keluarKoli,
                            $masukPcs - $keluarPcs,
                            $keuntungan
                        ]
                    );
                }


                /*
                |--------------------------------------------------------------------------
                | BARANG KELUAR
                |--------------------------------------------------------------------------
                */

                fputcsv(
                    $handle,
                    []
                );


                fputcsv(
                    $handle,
                    []
                );


                fputcsv(
                    $handle,
                    ['BARANG KELUAR']
                );


                fputcsv(
                    $handle,
                    [
                        'No',
                        'Tanggal & Jam Keluar',
                        'No Nota',
                        'Nama Customer',
                        'Barang',
                        'Koli',
                        'PCS',
                        'Harga / PCS',
                        'Subtotal',
                        'Diskon',
                        'Total Setelah Diskon'
                    ]
                );


                foreach (
                    $barangKeluar
                    as $index => $detail
                ) {

                    $penjualan =
                        $detail->penjualan;


                    $subtotal =
                        (float) (
                            $detail->subtotal ?? 0
                        );


                    /*
                    |--------------------------------------------------------------------------
                    | DISKON NOMINAL
                    |--------------------------------------------------------------------------
                    */

                    $nominalDiskon = 0;

                    if ($penjualan) {

                        $nominalDiskon =
                            (float) (
                                $penjualan
                                    ->getRawOriginal(
                                        'diskon'
                                    )
                                ?? 0
                            );
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | BATASI DISKON
                    |--------------------------------------------------------------------------
                    */

                    $nominalDiskon =
                        min(
                            max(0, $nominalDiskon),
                            $subtotal
                        );


                    /*
                    |--------------------------------------------------------------------------
                    | TOTAL SETELAH DISKON
                    |--------------------------------------------------------------------------
                    */

                    $total =
                        $subtotal -
                        $nominalDiskon;


                    /*
                    |--------------------------------------------------------------------------
                    | TANGGAL
                    |--------------------------------------------------------------------------
                    */

                    $tanggal = '';


                    if (
                        $penjualan &&
                        $penjualan->tanggal_penjualan
                    ) {

                        $tanggal =
                            \Carbon\Carbon::parse(
                                $penjualan->tanggal_penjualan
                            )
                            ->format('d/m/Y H:i');
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | EXPORT CSV
                    |--------------------------------------------------------------------------
                    */

                    fputcsv(
                        $handle,
                        [
                            $index + 1,
                            $tanggal,
                            $penjualan?->nomor_nota ?? '-',
                            $penjualan?->nama_customer ?? '-',
                            $detail->barang?->nama_barang ?? '-',
                            $detail->jumlah_koli ?? 0,
                            $detail->jumlah_pcs ?? 0,
                            $detail->harga ?? 0,
                            $subtotal,
                            $nominalDiskon,
                            $total
                        ]
                    );
                }


                fclose($handle);

            },

            $filename,
            $headers
        );
    }
}