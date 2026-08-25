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
     * Menampilkan daftar barang
     */
    public function index()
    {
        $barangs = Barang::latest()->paginate(10);

        return view('barangs.index', compact('barangs'));
    }

    /**
     * Form tambah barang
     */
    public function create()
    {
        return view('barangs.create');
    }

    /**
     * Simpan barang secara manual
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'jumlah_koli' => 'required|integer|min:1',
            'pcs_per_koli' => 'required|integer|min:1',
        ]);

        Barang::create($validated);

        return redirect()
            ->route('barangs.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    /**
     * Form edit barang
     */
    public function edit(Barang $barang)
    {
        return view('barangs.edit', compact('barang'));
    }

    /**
     * Update barang
     */
    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'jumlah_koli' => 'required|integer|min:1',
            'pcs_per_koli' => 'required|integer|min:1',
        ]);

        $barang->update($validated);

        return redirect()
            ->route('barangs.index')
            ->with('success', 'Barang berhasil diperbarui.');
    }

    /**
     * Hapus barang
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();

        return redirect()
            ->route('barangs.index')
            ->with('success', 'Barang berhasil dihapus.');
    }

    /**
     * Form import Excel
     */
    public function importForm()
    {
        return view('barangs.import');
    }

    /**
     * Proses import Excel
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:5120',
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
     * Export data barang ke Excel
     */
    public function export()
    {
        return Excel::download(
            new BarangExport(),
            'data-barang.xlsx'
        );
    }
}