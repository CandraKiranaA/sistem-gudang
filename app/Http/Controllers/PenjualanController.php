<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Menampilkan daftar Stock Out / Penjualan
     */
    public function index()
    {
        $penjualans = Penjualan::with('details.barang')
            ->latest()
            ->get();

        return view('penjualan.index', compact('penjualans'));
    }


    /**
     * Form membuat penjualan / nota
     */
    public function create()
    {
        // Hanya barang yang pernah memiliki Stock In
        $barangs = Barang::whereHas('barangMasuks')
            ->with('barangMasuks')
            ->orderBy('nama_barang')
            ->get();

        return view('penjualan.create', compact('barangs'));
    }


    /**
     * Mengecek stok barang
     */
    private function getStokBarang($barangId)
    {
        $barang = Barang::with('barangMasuks')
            ->findOrFail($barangId);


        /*
         * Total barang masuk
         */
        $totalKoliMasuk = $barang->barangMasuks
            ->sum('jumlah_koli');

        $totalPcsMasuk = $barang->barangMasuks
            ->sum('jumlah_pcs');


        /*
         * Total barang keluar
         */
        $totalKoliKeluar = PenjualanDetail::where(
            'barang_id',
            $barangId
        )->sum('jumlah_koli');

        $totalPcsKeluar = PenjualanDetail::where(
            'barang_id',
            $barangId
        )->sum('jumlah_pcs');


        /*
         * Stok akhir
         */
        $stokKoli = $totalKoliMasuk - $totalKoliKeluar;

        $stokPcs = $totalPcsMasuk - $totalPcsKeluar;


        return [
            'koli' => max(0, $stokKoli),
            'pcs' => max(0, $stokPcs),
        ];
    }


    /**
     * API untuk mengambil stok barang
     */
    public function stok(Barang $barang)
    {
        $stok = $this->getStokBarang($barang->id);

        $hargaJual = $barang->barangMasuks
            ->sortByDesc('tanggal_input')
            ->first()?->harga_jual_pcs ?? 0;


        return response()->json([
            'koli' => $stok['koli'],
            'pcs' => $stok['pcs'],
            'pcs_per_koli' => $barang->pcs_per_koli,
            'harga' => $hargaJual,
        ]);
    }


    /**
     * Menyimpan transaksi penjualan
     */
    public function store(Request $request)
    {
        $request->validate([

            'nama_customer' => [
                'required',
                'string',
                'max:255'
            ],

            'tanggal_penjualan' => [
                'required',
                'date'
            ],

            'barang_id' => [
                'required',
                'array',
                'min:1'
            ],

            'barang_id.*' => [
                'required',
                'exists:barangs,id'
            ],

            'jumlah_koli' => [
                'required',
                'array'
            ],

            'jumlah_koli.*' => [
                'required',
                'integer',
                'min:0'
            ],

            'jumlah_pcs' => [
                'required',
                'array'
            ],

            'jumlah_pcs.*' => [
                'required',
                'integer',
                'min:0'
            ],

        ]);


        DB::beginTransaction();


        try {

            /*
             * ============================================
             * NOMOR NOTA
             * ============================================
             */

            $tanggal = now()->format('Ymd');

            $jumlahHariIni = Penjualan::whereDate(
                'created_at',
                today()
            )->count() + 1;


            $nomorNota =
                'NOTA-' .
                $tanggal .
                '-' .
                str_pad(
                    $jumlahHariIni,
                    4,
                    '0',
                    STR_PAD_LEFT
                );


            /*
             * ============================================
             * BUAT PENJUALAN
             * ============================================
             */

            $penjualan = Penjualan::create([

                'nomor_nota' => $nomorNota,

                'nama_customer' =>
                    $request->nama_customer,

                'tanggal_penjualan' =>
                    $request->tanggal_penjualan,

                'total' => 0,

            ]);


            $total = 0;

            $adaBarang = false;


            /*
             * ============================================
             * PROSES BARANG
             * ============================================
             */

            foreach ($request->barang_id as $index => $barangId) {

                $jumlahKoli =
                    (int) (
                        $request->jumlah_koli[$index] ?? 0
                    );

                $jumlahPcs =
                    (int) (
                        $request->jumlah_pcs[$index] ?? 0
                    );


                /*
                 * Kalau jumlah kosong,
                 * lewati baris tersebut.
                 */

                if (
                    $jumlahKoli <= 0 &&
                    $jumlahPcs <= 0
                ) {
                    continue;
                }


                /*
                 * ========================================
                 * AMBIL BARANG
                 * ========================================
                 */

                $barang = Barang::with('barangMasuks')
                    ->findOrFail($barangId);


                /*
                 * ========================================
                 * CEK STOK
                 * ========================================
                 */

                $stok =
                    $this->getStokBarang(
                        $barang->id
                    );


                /*
                 * PCS PER KOLI
                 */

                $pcsPerKoli =
                    (int) $barang->pcs_per_koli;


                /*
                 * Total PCS yang ingin dijual
                 */

                $totalPcsKeluar =
                    ($jumlahKoli * $pcsPerKoli)
                    + $jumlahPcs;


                /*
                 * Total PCS yang tersedia
                 */

                $totalPcsStok =
                    ($stok['koli'] * $pcsPerKoli)
                    + $stok['pcs'];


                /*
                 * Kalau stok tidak cukup
                 */

                if (
                    $totalPcsKeluar >
                    $totalPcsStok
                ) {

                    DB::rollBack();


                    return back()
                        ->withInput()
                        ->with(
                            'error',

                            'Stok ' .
                            $barang->nama_barang .
                            ' tidak mencukupi. ' .

                            'Stok tersedia: ' .

                            $stok['koli'] .
                            ' koli / ' .

                            $stok['pcs'] .
                            ' pcs.'
                        );
                }


                /*
                 * ========================================
                 * AMBIL HARGA JUAL TERBARU
                 * ========================================
                 */

                $barangMasukTerakhir =
                    $barang->barangMasuks
                        ->sortByDesc('tanggal_input')
                        ->first();


                $harga =
                    (float) (
                        $barangMasukTerakhir
                            ? $barangMasukTerakhir
                                ->harga_jual_pcs
                            : 0
                    );


                /*
                 * ========================================
                 * HITUNG SUBTOTAL
                 * ========================================
                 */

                $totalPcs =
                    $totalPcsKeluar;


                $subtotal =
                    $totalPcs * $harga;


                /*
                 * ========================================
                 * SIMPAN DETAIL
                 * ========================================
                 */

                PenjualanDetail::create([

                    'penjualan_id' =>
                        $penjualan->id,

                    'barang_id' =>
                        $barang->id,

                    'jumlah_koli' =>
                        $jumlahKoli,

                    'jumlah_pcs' =>
                        $jumlahPcs,

                    'harga' =>
                        $harga,

                    'subtotal' =>
                        $subtotal,

                ]);


                $total += $subtotal;

                $adaBarang = true;
            }


            /*
             * ============================================
             * PASTIKAN ADA BARANG
             * ============================================
             */

            if (!$adaBarang) {

                DB::rollBack();


                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'Minimal harus ada satu barang yang dijual.'
                    );
            }


            /*
             * ============================================
             * UPDATE TOTAL
             * ============================================
             */

            $penjualan->update([

                'total' => $total,

            ]);


            /*
             * ============================================
             * COMMIT
             * ============================================
             */

            DB::commit();


            return redirect()
                ->route(
                    'penjualan.show',
                    $penjualan->id
                )
                ->with(
                    'success',
                    'Penjualan berhasil dibuat.'
                );


        } catch (\Throwable $e) {

            DB::rollBack();


            return back()
                ->withInput()
                ->with(
                    'error',
                    'Gagal membuat penjualan: ' .
                    $e->getMessage()
                );
        }
    }


    /**
     * Detail nota
     */
    public function show(Penjualan $penjualan)
    {
        $penjualan->load(
            'details.barang'
        );

        return view(
            'penjualan.show',
            compact('penjualan')
        );
    }
}