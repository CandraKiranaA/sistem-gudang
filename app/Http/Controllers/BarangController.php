<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Imports\BarangImport;
use App\Exports\BarangExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BarangController extends Controller
{
    /**
     * =========================================================
     * MENAMPILKAN DAFTAR BARANG
     * =========================================================
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Barang::query();

        if ($search) {

            $query->where(function ($q) use ($search) {

                $q->where(
                    'nama_barang',
                    'like',
                    '%' . $search . '%'
                )

                ->orWhere(
                    'satuan',
                    'like',
                    '%' . $search . '%'
                );

            });
        }

        $barangs = $query
            ->latest()
            ->paginate(50)
            ->withQueryString();

        return view(
            'barangs.index',
            compact(
                'barangs',
                'search'
            )
        );
    }


    /**
     * =========================================================
     * FORM TAMBAH BARANG
     * =========================================================
     */
    public function create()
    {
        return view('barangs.create');
    }


    /**
     * =========================================================
     * SIMPAN BARANG SECARA MANUAL
     * =========================================================
     */
    public function store(Request $request)
{
    $validated = $request->validate([

        'nama_barang' => [
            'required',
            'string',
            'max:255'
        ],

        'satuan' => [
            'required',
            'string',
            'max:50'
        ],

        'jumlah_koli' => [
            'required',
            'integer',
            'min:0'
        ],

        'pcs_per_koli' => [
            'required',
            'integer',
            'min:1'
        ],

    ]);

    Barang::create($validated);

    return redirect()
        ->route('barangs.index')
        ->with(
            'success',
            'Barang berhasil ditambahkan.'
        );
}

    /**
     * =========================================================
     * FORM EDIT BARANG
     * =========================================================
     */
    public function edit(Barang $barang)
    {
        return view(
            'barangs.edit',
            compact('barang')
        );
    }


    /**
     * =========================================================
     * UPDATE BARANG
     * =========================================================
     */
    public function update(
    Request $request,
    Barang $barang
) {

    $validated = $request->validate([

        'nama_barang' => [
            'required',
            'string',
            'max:255'
        ],

        'satuan' => [
            'required',
            'string',
            'max:50'
        ],

        'jumlah_koli' => [
            'required',
            'integer',
            'min:0'
        ],

        'pcs_per_koli' => [
            'required',
            'integer',
            'min:1'
        ],

    ]);

    $barang->update($validated);

    return redirect()
        ->route('barangs.index')
        ->with(
            'success',
            'Barang berhasil diperbarui.'
        );
}
    /**
     * =========================================================
     * HAPUS SATU BARANG
     * =========================================================
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();

        return redirect()
            ->route('barangs.index')
            ->with(
                'success',
                'Barang berhasil dihapus.'
            );
    }


    /**
     * =========================================================
     * FORM IMPORT EXCEL
     * =========================================================
     */
    public function importForm()
    {
        return view('barangs.import');
    }


    /**
     * =========================================================
     * PROSES IMPORT EXCEL
     * =========================================================
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:102400',
        ]);

        try {

            Excel::import(
                new BarangImport(),
                $request->file('file')
            );

            return redirect()
                ->route('barangs.index')
                ->with(
                    'success',
                    'Data barang berhasil diimport dari Excel.'
                );

        } catch (\Throwable $e) {

            return redirect()
                ->route('barangs.import.form')
                ->with(
                    'error',
                    'Import gagal: ' . $e->getMessage()
                );
        }
    }


    /**
     * =========================================================
     * EXPORT BARANG KE EXCEL
     * =========================================================
     */
    public function export()
    {
        return Excel::download(
            new BarangExport(),
            'data-barang.xlsx'
        );
    }


    /**
     * =========================================================
     * HAPUS BARANG TERPILIH
     * =========================================================
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => [
                'required',
                'array',
                'min:1'
            ],

            'ids.*' => [
                'integer',
                'exists:barangs,id'
            ],
        ]);

        $ids = $request->input('ids');

        $jumlah = count($ids);

        Barang::whereIn('id', $ids)->delete();

        return redirect()
            ->route('barangs.index')
            ->with(
                'success',
                $jumlah . ' barang berhasil dihapus.'
            );
    }
}
