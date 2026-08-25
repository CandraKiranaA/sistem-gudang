@extends('layouts.app')

@section('content')

<div class="container">

    {{-- HEADER --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="mb-1">
                Detail Customer
            </h3>

            <p class="text-muted mb-0">
                Informasi lengkap customer.
            </p>

        </div>

        <a
            href="{{ route('customers.index') }}"
            class="btn btn-outline-secondary"
        >
            ← Kembali
        </a>

    </div>


    {{-- CARD --}}

    <div class="card shadow-sm">

        <div class="card-header bg-white">

            <h5 class="mb-1">
                {{ $customer->nama_customer }}
            </h5>

            <small class="text-muted">
                Detail informasi customer
            </small>

        </div>


        <div class="card-body">

            <div class="row g-4">

                {{-- NAMA --}}

                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Nama Customer
                    </label>

                    <div class="form-control bg-light">
                        {{ $customer->nama_customer }}
                    </div>

                </div>


                {{-- TELEPON --}}

                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Nomor Telepon
                    </label>

                    <div class="form-control bg-light">

                        {{ $customer->no_telepon ?: '-' }}

                    </div>

                </div>


                {{-- ALAMAT --}}

                <div class="col-12">

                    <label class="form-label fw-semibold">
                        Alamat
                    </label>

                    <div
                        class="form-control bg-light"
                        style="min-height: 80px;"
                    >
                        {{ $customer->alamat ?: '-' }}
                    </div>

                </div>


                {{-- TOTAL TRANSAKSI --}}

                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Total Transaksi
                    </label>

                    <div class="form-control bg-light">

                        {{ number_format(
                            $customer->transaksis_count ?? 0
                        ) }}

                        Transaksi

                    </div>

                </div>

            </div>

        </div>


        <div class="card-footer bg-white">

            <div class="d-flex justify-content-end gap-2">

                <a
                    href="{{ route(
                        'customers.edit',
                        $customer
                    ) }}"
                    class="btn btn-warning"
                >
                    ✏️ Edit
                </a>

                <a
                    href="{{ route('customers.index') }}"
                    class="btn btn-light border"
                >
                    Kembali
                </a>

            </div>

        </div>

    </div>

</div>

@endsection