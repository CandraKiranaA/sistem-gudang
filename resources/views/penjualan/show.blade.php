@extends('layouts.app')

@section('title', 'Nota Penjualan')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h3 class="fw-bold mb-1">
            🧾 Nota Penjualan
        </h3>

        <p class="text-muted mb-0">
            {{ $penjualan->nomor_nota }}
        </p>

    </div>


    <div>

        <button
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


<div
    class="card shadow-sm"
    id="nota"
>

    <div class="card-body p-4">


        <div class="text-center mb-4">

            <h2 class="fw-bold mb-1">
                SISTEM GUDANG
            </h2>

            <p class="mb-0">
                NOTA PENJUALAN
            </p>

        </div>


        <div class="row mb-4">

            <div class="col-md-6">

                <strong>
                    No. Nota:
                </strong>

                <br>

                {{ $penjualan->nomor_nota }}

            </div>


            <div class="col-md-6 text-md-end">

                <strong>
                    Tanggal:
                </strong>

                <br>

                {{ $penjualan->tanggal_penjualan->format('d/m/Y H:i') }}

            </div>

        </div>


        <div class="mb-4">

            <strong>
                Customer:
            </strong>

            {{ $penjualan->nama_customer }}

        </div>


        <div class="table-responsive">

            <table class="table table-bordered">

                <thead>

                    <tr>

                        <th>
                            No
                        </th>

                        <th>
                            Barang
                        </th>

                        <th>
                            Koli
                        </th>

                        <th>
                            PCS
                        </th>

                        <th>
                            Harga
                        </th>

                        <th>
                            Subtotal
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach($penjualan->details as $index => $detail)

                        <tr>

                            <td>
                                {{ $index + 1 }}
                            </td>

                            <td>
                                {{ $detail->barang->nama }}
                            </td>

                            <td>
                                {{ $detail->jumlah_koli }}
                            </td>

                            <td>
                                {{ $detail->jumlah_pcs }}
                            </td>

                            <td>
                                Rp
                                {{ number_format($detail->harga, 0, ',', '.') }}
                            </td>

                            <td>
                                Rp
                                {{ number_format($detail->subtotal, 0, ',', '.') }}
                            </td>

                        </tr>

                    @endforeach

                </tbody>


                <tfoot>

                    <tr>

                        <th
                            colspan="5"
                            class="text-end"
                        >
                            TOTAL
                        </th>

                        <th>
                            Rp
                            {{ number_format($penjualan->total, 0, ',', '.') }}
                        </th>

                    </tr>

                </tfoot>

            </table>

        </div>


        <div class="text-end mt-5">

            <p class="mb-0">
                Terima kasih atas pembelian Anda.
            </p>

        </div>


    </div>

</div>


<style>

@media print {

    body {
        background: white !important;
    }

    .sidebar,
    .btn,
    nav {
        display: none !important;
    }

    .col-md-10 {
        width: 100% !important;
    }

    .content {
        padding: 0 !important;
    }

    .card {
        box-shadow: none !important;
    }

}

</style>

@endsection