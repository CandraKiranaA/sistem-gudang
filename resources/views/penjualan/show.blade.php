
@extends('layouts.app')

@section('title', 'Nota Penjualan')

@section('content')

<div class="container-fluid px-3 px-md-4 py-3">

    {{-- =====================================================
        HEADER
    ====================================================== --}}

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                🧾 Nota Penjualan
            </h3>

            <p class="text-muted mb-0">
                {{ $penjualan->nomor_nota }}
            </p>
        </div>

        <div class="d-flex gap-2 mt-3 mt-md-0">

            <button
                type="button"
                onclick="window.print()"
                class="btn btn-dark"
            >
                🖨️ Cetak Nota
            </button>

            <a
                href="{{ route('penjualan.index') }}"
                class="btn btn-outline-secondary"
            >
                Kembali
            </a>

        </div>

    </div>


    {{-- =====================================================
        NOTA
    ====================================================== --}}

    <div class="card shadow-sm border-0" id="nota">

        <div class="card-body p-4 p-md-5">

            {{-- HEADER NOTA --}}

            <div class="text-center mb-4">

                <h2 class="fw-bold mb-1">
                    Perabot Heri Grosir
                </h2>

                <p class="mb-0 text-muted">
                    NOTA PENJUALAN
                </p>

            </div>

            <hr>


            {{-- INFORMASI NOTA --}}

            <div class="row mb-4 mt-4">

                <div class="col-md-6 mb-3 mb-md-0">

                    <div class="text-muted small">
                        NO. NOTA
                    </div>

                    <div class="fw-bold">
                        {{ $penjualan->nomor_nota }}
                    </div>

                </div>

                <div class="col-md-6 text-md-end">

                    <div class="text-muted small">
                        TANGGAL
                    </div>

                    <div class="fw-bold">
                        {{ $penjualan->tanggal_penjualan
                            ? $penjualan->tanggal_penjualan->format('d/m/Y H:i')
                            : '-' }}
                    </div>

                </div>

            </div>


            {{-- CUSTOMER --}}

            <div class="customer-box mb-4">

                <div class="text-muted small mb-1">
                    CUSTOMER
                </div>

                <div class="fw-bold fs-5">
                    {{ $penjualan->nama_customer ?: '-' }}
                </div>

            </div>


            {{-- DETAIL BARANG --}}

            <div class="table-responsive">

                <table class="table table-bordered align-middle nota-table">

                    <thead>
                        <tr>

                            <th class="text-center" style="width: 60px;">
                                No
                            </th>

                            <th>
                                Nama Barang
                            </th>

                            <th class="text-center" style="width: 100px;">
                                Koli
                            </th>

                            <th class="text-center" style="width: 100px;">
                                PCS
                            </th>

                            <th class="text-end" style="width: 160px;">
                                Harga
                            </th>

                            <th class="text-end" style="width: 180px;">
                                Subtotal
                            </th>

                        </tr>
                    </thead>

                    <tbody>

                        @forelse($penjualan->details as $index => $detail)

                            <tr>

                                <td class="text-center">
                                    {{ $index + 1 }}
                                </td>

                                <td>

                                    <div class="fw-semibold">

                                        @if($detail->barang)

                                            {{ $detail->barang->nama_barang
                                                ?? $detail->barang->nama
                                                ?? $detail->barang->kode_barang
                                                ?? 'Nama barang tidak tersedia' }}

                                        @else

                                            <span class="text-danger">
                                                Barang tidak ditemukan
                                            </span>

                                        @endif

                                    </div>

                                </td>

                                <td class="text-center">
                                    {{ $detail->jumlah_koli ?? 0 }}
                                </td>

                                <td class="text-center">
                                    {{ $detail->jumlah_pcs ?? 0 }}
                                </td>

                                <td class="text-end">
                                    Rp {{ number_format(
                                        $detail->harga ?? 0,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </td>

                                <td class="text-end fw-semibold">
                                    Rp {{ number_format(
                                        $detail->subtotal ?? 0,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Belum ada detail barang.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>


                    {{-- =================================================
                        TOTAL + PEMBAYARAN
                    ================================================== --}}

                    <tfoot>

                        {{-- TOTAL --}}

                        <tr>

                            <th colspan="5" class="text-end">
                                TOTAL
                            </th>

                            <th class="text-end">

                                Rp {{ number_format(
                                    $penjualan->total ?? 0,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </th>

                        </tr>


                        {{-- BAYAR CASH --}}

                        <tr>

                            <th colspan="5" class="text-end">
                                BAYAR CASH
                            </th>

                            <th class="text-end">

                                Rp {{ number_format(
                                    $penjualan->bayar_cash ?? 0,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </th>

                        </tr>


                        {{-- HUTANG --}}

                        <tr>

                            <th colspan="5" class="text-end">
                                HUTANG
                            </th>

                            <th class="text-end">

                                Rp {{ number_format(
                                    $penjualan->hutang ?? 0,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </th>

                        </tr>


                        {{-- STATUS PEMBAYARAN --}}

                        <tr>

                            <th colspan="5" class="text-end">
                                STATUS PEMBAYARAN
                            </th>

                            <th class="text-end">

                                @if(($penjualan->hutang ?? 0) > 0)

                                    <span class="badge bg-warning text-dark">
                                        HUTANG
                                    </span>

                                @else

                                    <span class="badge bg-success">
                                        LUNAS
                                    </span>

                                @endif

                            </th>

                        </tr>

                    </tfoot>

                </table>

            </div>


            {{-- FOOTER NOTA --}}

            <div class="text-end mt-5">

                <p class="mb-0">
                    Terima kasih atas pembelian Anda.
                </p>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
    STYLE
========================================================= --}}

<style>

.customer-box {

    background: #f8fafc;

    border: 1px solid #e9ecef;

    border-radius: 10px;

    padding: 14px 18px;

}

.nota-table {

    font-size: 14px;

}

.nota-table thead th {

    background: #f8fafc;

    font-size: 13px;

    text-transform: uppercase;

    letter-spacing: .3px;

    color: #475569;

    padding: 13px 12px;

}

.nota-table tbody td {

    padding: 13px 12px;

}

.nota-table tfoot th {

    background: #f8fafc;

    padding: 14px 12px;

    font-size: 15px;

}


/* =========================================================
   PRINT
========================================================= */

@media print {

    @page {

        size: A4;

        margin: 15mm;

    }

    body {

        background: white !important;

    }

    .sidebar,
    nav,
    header,
    footer,
    .btn {

        display: none !important;

    }

    .container-fluid {

        width: 100% !important;
        max-width: 100% !important;
        padding: 0 !important;
        margin: 0 !important;

    }

    #nota {

        border: 0 !important;
        box-shadow: none !important;
        width: 100% !important;

    }

    #nota .card-body {

        padding: 0 !important;

    }

    .nota-table {

        width: 100% !important;

    }

}

</style>

@endsection

