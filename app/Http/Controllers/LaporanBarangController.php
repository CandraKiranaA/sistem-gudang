<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\PenjualanDetail;
use Illuminate\Http\Request;
use App\Exports\LaporanBarangExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanBarangController extends Controller
{
    /**
     * Menampilkan laporan barang
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $barangs = Barang::with('barangMasuks')
            ->when($search, function ($query) use ($search) {
                $query->where('nama_barang', 'like', '%' . $search . '%');
            })
            ->orderBy('nama_barang')
            ->get();

        $laporan = $barangs->map(function ($barang) {

            /*
            |--------------------------------------------------------------------------
            | BARANG MASUK
            |--------------------------------------------------------------------------
            */

            $barangMasuks = $barang->barangMasuks;

            $barangMasukKoli = $barangMasuks->sum('jumlah_koli');
            $barangMasukPcs = $barangMasuks->sum('jumlah_pcs');


            /*
            |--------------------------------------------------------------------------
            | BARANG KELUAR
            |--------------------------------------------------------------------------
            */

            $barangKeluar = PenjualanDetail::where(
                'barang_id',
                $barang->id
            )->get();

            $barangKeluarKoli = $barangKeluar->sum('jumlah_koli');
            $barangKeluarPcs = $barangKeluar->sum('jumlah_pcs');


            /*
            |--------------------------------------------------------------------------
            | PCS PER KOLI
            |--------------------------------------------------------------------------
            */

            $pcsPerKoli = (int) $barang->pcs_per_koli;

            if ($pcsPerKoli <= 0) {
                $pcsPerKoli = 1;
            }


            /*
            |--------------------------------------------------------------------------
            | KONVERSI BARANG MASUK KE TOTAL PCS
            |--------------------------------------------------------------------------
            */

            $totalPcsMasuk =
                ($barangMasukKoli * $pcsPerKoli)
                + $barangMasukPcs;


            /*
            |--------------------------------------------------------------------------
            | KONVERSI BARANG KELUAR KE TOTAL PCS
            |--------------------------------------------------------------------------
            */

            $totalPcsKeluar =
                ($barangKeluarKoli * $pcsPerKoli)
                + $barangKeluarPcs;


            /*
            |--------------------------------------------------------------------------
            | SISA BARANG
            |--------------------------------------------------------------------------
            */

            $totalPcsSisa =
                $totalPcsMasuk - $totalPcsKeluar;


            /*
            |--------------------------------------------------------------------------
            | UBAH TOTAL PCS MENJADI KOLI + PCS
            |--------------------------------------------------------------------------
            */

            $sisaKoli = intdiv(
                max(0, $totalPcsSisa),
                $pcsPerKoli
            );

            $sisaPcs = max(0, $totalPcsSisa)
                % $pcsPerKoli;


            /*
            |--------------------------------------------------------------------------
            | HARGA BELI
            |--------------------------------------------------------------------------
            */

            $totalModal = 0;

            foreach ($barangMasuks as $masuk) {

                $jumlahKoli = (int) $masuk->jumlah_koli;

                $jumlahPcs = (int) $masuk->jumlah_pcs;

                $hargaBeliKoli =
                    (float) $masuk->harga_beli_koli;

                /*
                 * Modal dari koli
                 */
                $modalKoli =
                    $jumlahKoli * $hargaBeliKoli;

                /*
                 * Harga modal per PCS
                 */
                $hargaModalPcs =
                    $pcsPerKoli > 0
                    ? $hargaBeliKoli / $pcsPerKoli
                    : 0;

                /*
                 * Modal dari PCS
                 */
                $modalPcs =
                    $jumlahPcs * $hargaModalPcs;

                $totalModal +=
                    $modalKoli + $modalPcs;
            }


            /*
            |--------------------------------------------------------------------------
            | TOTAL PENJUALAN
            |--------------------------------------------------------------------------
            */

            $totalPenjualan =
                $barangKeluar->sum('subtotal');


            /*
            |--------------------------------------------------------------------------
            | KEUNTUNGAN
            |--------------------------------------------------------------------------
            |
            | Untuk laporan sederhana:
            |
            | Keuntungan =
            | Penjualan - perkiraan modal barang keluar
            |
            */

            $totalBarangMasukPcs =
                max(1, $totalPcsMasuk);

            $rataRataModalPcs =
                $totalModal / $totalBarangMasukPcs;

            $modalBarangKeluar =
                $totalPcsKeluar * $rataRataModalPcs;

            $keuntungan =
                $totalPenjualan - $modalBarangKeluar;


            /*
            |--------------------------------------------------------------------------
            | HASIL LAPORAN
            |--------------------------------------------------------------------------
            */

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

                'sisa_koli' =>
                    $sisaKoli,

                'sisa_pcs' =>
                    $sisaPcs,

                'keuntungan' =>
                    $keuntungan,
            ];
        });


        return view(
            'laporan.barang.index',
            compact(
                'laporan',
                'search'
            )
        );
    }


    /**
     * Detail laporan barang
     */
    public function show($id)
    {
        $barang = Barang::with('barangMasuks')
            ->findOrFail($id);


        $penjualanDetails =
            PenjualanDetail::with('penjualan')
                ->where('barang_id', $barang->id)
                ->latest()
                ->get();


        return view(
            'laporan.barang.show',
            compact(
                'barang',
                'penjualanDetails'
            )
        );

    }

    public function exportExcel()
    {
        return Excel::download(
            new LaporanBarangExport,
            'laporan-barang.xlsx'
        );
    }
}