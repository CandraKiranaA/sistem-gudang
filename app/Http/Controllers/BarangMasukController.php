<?php

namespace App\Http\Controllers;

use App\Http\Requests\BarangMasukRequest;
use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    /**
     * Menampilkan daftar barang masuk
     */
    public function index(Request $request)
    {
        $query = BarangMasuk::with('barang')
            ->latest('tanggal_input');

        // Pencarian berdasarkan nama barang
        if ($request->filled('search')) {

            $search = $request->search;

            $query->whereHas('barang', function ($q) use ($search) {

                $q->where(
                    'nama_barang',
                    'like',
                    "%{$search}%"
                );

            });
        }

        // Filter tanggal mulai
        if ($request->filled('tanggal_mulai')) {

            $query->whereDate(
                'tanggal_input',
                '>=',
                $request->tanggal_mulai
            );
        }

        // Filter tanggal selesai
        if ($request->filled('tanggal_selesai')) {

            $query->whereDate(
                'tanggal_input',
                '<=',
                $request->tanggal_selesai
            );
        }

        $barangMasuks = $query
            ->paginate(15)
            ->withQueryString();

        return view(
            'barang-masuk.index',
            compact('barangMasuks')
        );
    }


    /**
     * Form tambah barang masuk
     */
    public function create()
    {
        /*
         * Ambil semua barang dari tabel barangs.
         *
         * Jadi barang yang sudah dimasukkan di
         * Master Barang seperti:
         *
         * Kipas
         * Lemari
         * Meja
         *
         * otomatis muncul di dropdown.
         */
        $barangs = Barang::orderBy(
            'nama_barang',
            'asc'
        )->get();

        return view(
            'barang-masuk.create',
            compact('barangs')
        );
    }


    /**
     * Simpan barang masuk
     */
    public function store(BarangMasukRequest $request)
    {
        /*
         * Ambil barang yang dipilih.
         */
        $barang = Barang::findOrFail(
            $request->barang_id
        );


        /*
         * Hitung PCS otomatis.
         *
         * Contoh:
         *
         * pcs_per_koli = 2
         * jumlah_koli = 5
         *
         * maka:
         *
         * 5 x 2 = 10 PCS
         */
        $jumlahPcs =
            $request->jumlah_koli
            * $barang->pcs_per_koli;


        BarangMasuk::create([

            'tanggal_input' =>
                $request->tanggal_input,

            'barang_id' =>
                $request->barang_id,

            'jumlah_koli' =>
                $request->jumlah_koli,

            'jumlah_pcs' =>
                $jumlahPcs,

            'harga_beli_koli' =>
                $request->harga_beli_koli,

            'harga_jual_koli' =>
                $request->harga_jual_koli,

            'harga_jual_pcs' =>
                $request->harga_jual_pcs,

        ]);


        return redirect()
            ->route('barang-masuk.index')
            ->with(
                'success',
                'Barang masuk berhasil ditambahkan.'
            );
    }


    /**
     * Detail barang masuk
     */
    public function show(
        BarangMasuk $barangMasuk
    ) {
        $barangMasuk->load('barang');

        return view(
            'barang-masuk.show',
            compact('barangMasuk')
        );
    }


    /**
     * Form edit
     */
    public function edit(
        BarangMasuk $barangMasuk
    ) {
        $barangs = Barang::orderBy(
            'nama_barang',
            'asc'
        )->get();

        return view(
            'barang-masuk.edit',
            compact(
                'barangMasuk',
                'barangs'
            )
        );
    }


    /**
     * Update barang masuk
     */
    public function update(
        BarangMasukRequest $request,
        BarangMasuk $barangMasuk
    ) {
        /*
         * Ambil barang terbaru.
         */
        $barang = Barang::findOrFail(
            $request->barang_id
        );


        /*
         * Hitung ulang PCS.
         */
        $jumlahPcs =
            $request->jumlah_koli
            * $barang->pcs_per_koli;


        $barangMasuk->update([

            'tanggal_input' =>
                $request->tanggal_input,

            'barang_id' =>
                $request->barang_id,

            'jumlah_koli' =>
                $request->jumlah_koli,

            'jumlah_pcs' =>
                $jumlahPcs,

            'harga_beli_koli' =>
                $request->harga_beli_koli,

            'harga_jual_koli' =>
                $request->harga_jual_koli,

            'harga_jual_pcs' =>
                $request->harga_jual_pcs,

        ]);


        return redirect()
            ->route('barang-masuk.index')
            ->with(
                'success',
                'Barang masuk berhasil diperbarui.'
            );
    }


    /**
     * Hapus barang masuk
     */
    public function destroy(
        BarangMasuk $barangMasuk
    ) {
        $barangMasuk->delete();

        return redirect()
            ->route('barang-masuk.index')
            ->with(
                'success',
                'Data barang masuk berhasil dihapus.'
            );
    }
}