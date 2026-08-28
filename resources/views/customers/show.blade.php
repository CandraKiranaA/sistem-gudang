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

    {{-- CUSTOMER --}}

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


    {{-- TOTAL TRANSAKSI --}}

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


    {{-- TOTAL PEMBELIAN --}}

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

                        <th
                            class="text-center"
                            style="width: 60px;"
                        >
                            No
                        </th>

                        <th>
                            No. Nota
                        </th>

                        <th>
                            Tanggal
                        </th>

                        <th>
                            Nama Barang
                        </th>

                        <th class="text-center">
                            Jumlah
                        </th>

                        <th>
                            Total
                        </th>

                        <th
                            class="text-center"
                            style="width: 130px;"
                        >
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($penjualans as $penjualan)

                        <tr>

                            {{-- NO --}}

                            <td class="text-center">

                                {{ $loop->iteration }}

                            </td>


                            {{-- NOMOR NOTA --}}

                            <td>

                                <strong>
                                    {{ $penjualan->nomor_nota }}
                                </strong>

                            </td>


                            {{-- TANGGAL --}}

                            <td>

                                {{ $penjualan->tanggal_penjualan
                                    ? $penjualan->tanggal_penjualan->format('d/m/Y H:i')
                                    : '-' }}

                            </td>


                            {{-- NAMA BARANG --}}

                            <td>

                                @if($penjualan->details->count() > 0)

                                    <div class="product-list">

                                        @foreach($penjualan->details as $detail)

                                            <div class="product-item">

                                                <span class="product-name">

                                                    {{ $detail->barang->nama_barang ?? 'Barang tidak ditemukan' }}

                                                </span>

                                                @if($detail->jumlah_koli > 0)

                                                    <span class="product-qty">

                                                        {{ number_format($detail->jumlah_koli) }}
                                                        Koli

                                                    </span>

                                                @endif

                                            </div>

                                        @endforeach

                                    </div>

                                @else

                                    <span class="text-muted">
                                        Tidak ada barang
                                    </span>

                                @endif

                            </td>


                            {{-- JUMLAH BARANG --}}

                            <td class="text-center">

                                <span class="quantity-badge">

                                    {{ $penjualan->details->count() }}

                                    item

                                </span>

                            </td>


                            {{-- TOTAL --}}

                            <td>

                                <strong class="text-success">

                                    Rp
                                    {{ number_format(
                                        $penjualan->total,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </strong>

                            </td>


                            {{-- AKSI --}}

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
                                colspan="7"
                                class="text-center text-muted py-5"
                            >

                                <div class="empty-icon">
                                    👥
                                </div>

                                <div class="fw-bold mb-1">
                                    Belum ada transaksi
                                </div>

                                <small>
                                    Customer ini belum memiliki transaksi Stock Out.
                                </small>

                            </td>

                        </tr>

                    @endforelse

                </tbody>


                {{-- =================================================
                    TOTAL
                ================================================== --}}

                @if($penjualans->count() > 0)

                    <tfoot>

                        <tr>

                            <th
                                colspan="5"
                                class="text-end"
                            >
                                TOTAL
                            </th>

                            <th colspan="2">

                                <strong class="text-success">

                                    Rp
                                    {{ number_format(
                                        $penjualans->sum('total'),
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </strong>

                            </th>

                        </tr>

                    </tfoot>

                @endif

            </table>

        </div>

    </div>

</div>

</div>

{{-- =========================================================
STYLE
========================================================= --}}

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


.table {

    min-width: 900px;

}


.table thead th {

    background: #f8fafc;

    color: #475569;

    font-size: 13px;

    text-transform: uppercase;

    letter-spacing: .3px;

    padding: 15px;

    white-space: nowrap;

}


.table tbody td {

    padding: 15px;

    vertical-align: middle;

}


.table tbody tr:last-child td {

    border-bottom: 0;

}


/* =========================================================
   PRODUK
========================================================= */

.product-list {

    display: flex;

    flex-direction: column;

    gap: 6px;

}


.product-item {

    display: flex;

    flex-wrap: wrap;

    align-items: center;

    gap: 7px;

}


.product-name {

    font-weight: 600;

    color: #1e293b;

}


.product-qty {

    display: inline-flex;

    align-items: center;

    padding: 3px 7px;

    background: #eef6ff;

    color: #0d6efd;

    border-radius: 6px;

    font-size: 11px;

    font-weight: 700;

}


.quantity-badge {

    display: inline-block;

    padding: 5px 9px;

    background: #f1f5f9;

    color: #475569;

    border-radius: 7px;

    font-size: 13px;

    font-weight: 600;

}


.empty-icon {

    font-size: 30px;

    margin-bottom: 8px;

}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 768px) {

    .table {

        min-width: 900px;

    }

    .table thead th {

        font-size: 12px;

        padding: 12px;

    }

    .table tbody td {

        padding: 12px;

        font-size: 14px;

    }

}

</style>

@endsection
