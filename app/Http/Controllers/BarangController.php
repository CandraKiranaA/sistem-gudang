<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Daftar barang
     */
    public function index()
    {
        $barangs = Barang::latest()->paginate(10);

        return view(
            'barangs.index',
            compact('barangs')
        );
    }


    /**
     * Form tambah barang
     */
    public function create()
    {
        return view('barangs.create');
    }


    /**
     * Simpan barang
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => [
                'required',
                'string',
                'max:255',
            ],

            'satuan' => [
                'required',
                'string',
                'max:50',
            ],

            'jumlah_koli' => [
                'required',
                'integer',
                'min:1',
            ],

            'pcs_per_koli' => [
                'required',
                'integer',
                'min:1',
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
     * Form edit
     */
    public function edit(Barang $barang)
    {
        return view(
            'barangs.edit',
            compact('barang')
        );
    }


    /**
     * Update barang
     */
    public function update(
        Request $request,
        Barang $barang
    ) {

        $validated = $request->validate([
            'nama_barang' => [
                'required',
                'string',
                'max:255',
            ],

            'satuan' => [
                'required',
                'string',
                'max:50',
            ],

            'jumlah_koli' => [
                'required',
                'integer',
                'min:1',
            ],

            'pcs_per_koli' => [
                'required',
                'integer',
                'min:1',
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
     * Hapus barang
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
}