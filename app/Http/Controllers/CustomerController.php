<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * =========================================================
     * INDEX
     * =========================================================
     */
    public function index(Request $request)
    {
        $query = Customer::query();

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(
                'nama_customer',
                'like',
                '%' . $search . '%'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | DATA CUSTOMER
        |--------------------------------------------------------------------------
        */

        $customers = $query
            ->orderBy('nama_customer', 'asc')
            ->paginate(10)
            ->withQueryString();

        return view(
            'customers.index',
            compact('customers')
        );
    }


    /**
     * =========================================================
     * CREATE
     * =========================================================
     */
    public function create()
    {
        return view('customers.create');
    }


    /**
     * =========================================================
     * STORE
     * =========================================================
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_customer' => [
                'required',
                'string',
                'max:255',
            ],

            'no_telepon' => [
                'nullable',
                'string',
                'max:30',
            ],

            'alamat' => [
                'nullable',
                'string',
            ],
        ]);

        Customer::create($validated);

        return redirect()
            ->route('customers.index')
            ->with(
                'success',
                'Customer berhasil ditambahkan.'
            );
    }


    /**
     * =========================================================
     * SHOW
     * =========================================================
     */
    public function show(Customer $customer)
    {
        return view(
            'customers.show',
            compact('customer')
        );
    }


    /**
     * =========================================================
     * EDIT
     * =========================================================
     */
    public function edit(Customer $customer)
    {
        return view(
            'customers.edit',
            compact('customer')
        );
    }


    /**
     * =========================================================
     * UPDATE
     * =========================================================
     */
    public function update(
        Request $request,
        Customer $customer
    ) {
        $validated = $request->validate([
            'nama_customer' => [
                'required',
                'string',
                'max:255',
            ],

            'no_telepon' => [
                'nullable',
                'string',
                'max:30',
            ],

            'alamat' => [
                'nullable',
                'string',
            ],
        ]);

        $customer->update($validated);

        return redirect()
            ->route('customers.index')
            ->with(
                'success',
                'Data customer berhasil diperbarui.'
            );
    }


    /**
     * =========================================================
     * DESTROY
     * =========================================================
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->with(
                'success',
                'Customer berhasil dihapus.'
            );
    }
}