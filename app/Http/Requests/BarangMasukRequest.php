<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarangMasukRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'tanggal_input' =>
                'required|date',

            'barang_id' =>
                'required|exists:barangs,id',

            'jumlah_koli' =>
                'required|integer|min:1',

            'harga_beli_koli' =>
                'required|numeric|min:0',

            'harga_jual_koli' =>
                'required|numeric|min:0',

            'harga_jual_pcs' =>
                'required|numeric|min:0',

        ];
    }

    public function messages(): array
    {
        return [

            'tanggal_input.required' =>
                'Tanggal input wajib diisi.',

            'barang_id.required' =>
                'Barang wajib dipilih.',

            'barang_id.exists' =>
                'Barang yang dipilih tidak ditemukan.',

            'jumlah_koli.required' =>
                'Jumlah koli wajib diisi.',

            'jumlah_koli.min' =>
                'Jumlah koli minimal 1.',

        ];
    }
}