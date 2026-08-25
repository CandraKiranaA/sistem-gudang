@extends('layouts.app')

@section('title', 'Detail Customer')

@section('content')

<div class="container-fluid px-3 px-md-4 py-3">

    {{-- =====================================================
        HEADER
    ====================================================== --}}

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>

            <div class="d-flex align-items-center gap-2 mb-1">

                <div class="page-icon">
                    👥
                </div>

                <div>

                    <h3 class="fw-bold mb-0">
                        {{ $nama_customer }}
                    </h3>

                    <p class="text-muted mb-0">
                        Riwayat transaksi Stock Out customer
                    </p>

                </div>

            </div>

        </div>


        <div class="mt-3 mt-md-0">

            <a
                href="{{ route('customers.index') }}"
                class="btn btn-outline-secondary"
            >
                ← Kembali
            </a>

        </div>

    </div>


    {{-- =====================================================
        RINGKASAN
    ====================================================== --}}

    <div class="row g-3 mb-4">

        <div class="col-md-4">

            <div class="card border-0 shadow-sm summary-card">

                <div class="card-body">

                    <small class="text-muted">
                        Customer
                    </small>

                    <h5 class="fw-bold mb-0 mt-1">
                        {{ $nama_customer }}
                    </h5>

                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="card border-0 shadow-sm summary-card">

                <div class="card-body">

                    <small class="text-muted">
                        Total Transaksi
                    </small>

                    <h4 class="fw-bold text-primary mb-0 mt-1">
                        {{ $penjualans->count() }}
                    </h4>

                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="card border-0 shadow-sm summary-card">

                <div class="card-body">

                    <small class="text-muted">
                        Total Pembelian
                    </small>

                    <h5 class="fw-bold text-success mb-0 mt-1">

                        Rp
                        {{ number_format(
                            $penjualans->sum('total'),
                            0,
                            ',',
                            '.'
                        ) }}

                    </h5>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
        DAFTAR TRANSAKSI
    ====================================================== --}}

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 py-3">

            <h5 class="fw-bold mb-1">
                Riwayat Stock Out
            </h5>

            <small class="text-muted">
                Semua transaksi untuk customer {{ $nama_customer }}
            </small>

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead>

                        <tr>

                            <th class="text-center">
                                No
                            </th>

                            <th>
                                No. Nota
                            </th>

                            <th>
                                Tanggal
                            </th>

                            <th>
                                Jumlah Barang
                            </th>

                            <th>
                                Total
                            </th>

                            <th class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($penjualans as $penjualan)

                            <tr>

                                <td class="text-center">

                                    {{ $loop->iteration }}

                                </td>


                                <td>

                                    <strong>
                                        {{ $penjualan->nomor_nota }}
                                    </strong>

                                </td>


                                <td>

                                    {{ $penjualan->tanggal_penjualan
                                        ? $penjualan->tanggal_penjualan->format('d/m/Y H:i')
                                        : '-' }}

                                </td>


                                <td>

                                    {{ $penjualan->details->count() }}

                                    item

                                </td>


                                <td>

                                    <strong>

                                        Rp
                                        {{ number_format(
                                            $penjualan->total,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </strong>

                                </td>


                                <td class="text-center">

                                    <a
                                        href="{{ route(
                                            'penjualan.show',
                                            [
                                                'penjualan' => $penjualan->id
                                            ]
                                        ) }}"
                                        class="btn btn-sm btn-outline-primary"
                                    >
                                        👁️ Detail
                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="text-center text-muted py-5"
                                >

                                    Belum ada transaksi.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>


                    @if($penjualans->count() > 0)

                        <tfoot>

                            <tr>

                                <th
                                    colspan="4"
                                    class="text-end"
                                >
                                    TOTAL
                                </th>

                                <th colspan="2">

                                    Rp
                                    {{ number_format(
                                        $penjualans->sum('total'),
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </th>

                            </tr>

                        </tfoot>

                    @endif

                </table>

            </div>

        </div>

    </div>

</div>


<style>

.page-icon {

    width: 42px;
    height: 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #eef5ff;

    border-radius: 10px;

    font-size: 21px;

}


.summary-card {

    border-radius: 12px;

}


.card {

    border-radius: 12px;

}


.table thead th {

    background: #f8fafc;

    color: #475569;

    font-size: 13px;

    text-transform: uppercase;

    letter-spacing: .3px;

    padding: 15px;

}


.table tbody td {

    padding: 15px;

}


.table tbody tr:last-child td {

    border-bottom: 0;

}

</style>

@endsection