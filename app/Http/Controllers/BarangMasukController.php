<?php

namespace App\Http\Controllers;

use App\Http\Requests\BarangMasukRequest;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Imports\BarangMasukImport;
use App\Exports\BarangMasukExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
        $barang = Barang::findOrFail(
            $request->barang_id
        );

        /*
         * Hitung jumlah PCS.
         *
         * Contoh:
         * 5 koli x 2 pcs/koli = 10 pcs
         */
        $jumlahPcs =
            $request->jumlah_koli
            * $barang->pcs_per_koli;

        BarangMasuk::create([

            'tanggal_input' =>
                $request->tanggal_input,

            'barang_id' =>
                $request->barang_id,

            'edisi' =>
                $request->edisi,

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
        $barang = Barang::findOrFail(
            $request->barang_id
        );

        /*
         * Hitung ulang jumlah PCS.
         *
         * Contoh:
         * 5 koli x 2 pcs/koli = 10 pcs
         */
        $jumlahPcs =
            $request->jumlah_koli
            * $barang->pcs_per_koli;

        $barangMasuk->update([

            'tanggal_input' =>
                $request->tanggal_input,

            'barang_id' =>
                $request->barang_id,

            'edisi' =>
                $request->edisi,

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


    /*
    |--------------------------------------------------------------------------
    | IMPORT EXCEL
    |--------------------------------------------------------------------------
    */


    /**
     * Menampilkan halaman import Excel
     */
    public function importForm()
    {
        return view(
            'barang-masuk.import'
        );
    }


    /**
     * Proses import Excel
     */
    public function import(Request $request)
    {
        $request->validate([

            'file' => [
                'required',
                'file',
                'mimes:xlsx,xls,csv',
                'max:20480',
            ],

        ], [

            'file.required' =>
                'Silakan pilih file Excel terlebih dahulu.',

            'file.file' =>
                'File yang dikirim tidak valid.',

            'file.mimes' =>
                'Format file harus XLSX, XLS, atau CSV.',

            'file.max' =>
                'Ukuran file maksimal 20 MB.',

        ]);

        try {

            Excel::import(
                new BarangMasukImport,
                $request->file('file')
            );

            return redirect()
                ->route('barang-masuk.index')
                ->with(
                    'success',
                    'Data barang masuk berhasil diimport.'
                );

        } catch (\Throwable $e) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Import gagal: ' .
                    $e->getMessage()
                );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | EXPORT EXCEL
    |--------------------------------------------------------------------------
    */


    /**
     * Export data barang masuk ke Excel
     */
    public function export()
    {
        return Excel::download(
            new BarangMasukExport,
            'barang-masuk-' .
            now()->format('Y-m-d-His') .
            '.xlsx'
        );
    }
}