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
        | QUERY CUSTOMER
        |--------------------------------------------------------------------------
        | Setiap customer hanya ditampilkan satu kali.
        |
        | COUNT(*)  = jumlah transaksi customer
        | MAX(...)  = tanggal transaksi terakhir customer
        |
        | Customer yang transaksi paling baru akan berada di paling atas.
        |--------------------------------------------------------------------------
        */

        $query = Penjualan::query()
            ->select('nama_customer')
            ->selectRaw('COUNT(*) as total_transaksi')
            ->selectRaw('MAX(tanggal_penjualan) as transaksi_terakhir')
            ->whereNotNull('nama_customer')
            ->where('nama_customer', '!=', '');


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
        | GROUP CUSTOMER
        |--------------------------------------------------------------------------
        */

        $query
            ->groupBy('nama_customer')
            ->orderByRaw('MAX(tanggal_penjualan) DESC');


        /*
        |--------------------------------------------------------------------------
        | PAGINATION
        |--------------------------------------------------------------------------
        */

        $customers = $query
            ->paginate(10)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

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
        | AMBIL TRANSAKSI CUSTOMER
        |--------------------------------------------------------------------------
        | Transaksi terbaru berada paling atas.
        |--------------------------------------------------------------------------
        */

        $penjualans = Penjualan::with([
            'details.barang'
        ])
        ->where('nama_customer', $nama_customer)
        ->orderByDesc('tanggal_penjualan')
        ->get();


        /*
        |--------------------------------------------------------------------------
        | CUSTOMER TIDAK DITEMUKAN
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
        | KIRIM DATA KE VIEW
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

