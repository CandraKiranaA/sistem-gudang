<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DAFTAR CUSTOMER
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Ambil customer langsung dari tabel penjualans
        |--------------------------------------------------------------------------
        */

        $query = Penjualan::query()
            ->select('nama_customer')
            ->selectRaw('COUNT(*) as total_transaksi')
            ->whereNotNull('nama_customer')
            ->where('nama_customer', '!=', '')
            ->groupBy('nama_customer')
            ->orderBy('nama_customer');


        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(
                'nama_customer',
                'like',
                '%' . $search . '%'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | PAGINATION
        |--------------------------------------------------------------------------
        */

        $customers = $query
            ->paginate(10)
            ->withQueryString();


        return view(
            'customers.index',
            compact('customers')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DETAIL CUSTOMER
    |--------------------------------------------------------------------------
    */

    public function show($nama_customer)
    {
        /*
        |--------------------------------------------------------------------------
        | Decode nama customer
        |--------------------------------------------------------------------------
        */

        $nama_customer = urldecode($nama_customer);


        /*
        |--------------------------------------------------------------------------
        | Ambil semua transaksi Stock Out customer
        |--------------------------------------------------------------------------
        */

        $penjualans = Penjualan::with([
            'details.barang'
        ])
        ->where('nama_customer', $nama_customer)
        ->latest('tanggal_penjualan')
        ->get();


        /*
        |--------------------------------------------------------------------------
        | Kalau customer tidak ditemukan
        |--------------------------------------------------------------------------
        */

        if ($penjualans->isEmpty()) {

            return redirect()
                ->route('customers.index')
                ->with(
                    'error',
                    'Data customer tidak ditemukan.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Kirim nama customer dan transaksi
        |--------------------------------------------------------------------------
        */

        return view(
            'customers.show',
            [
                'nama_customer' => $nama_customer,
                'penjualans' => $penjualans
            ]
        );
    }
}