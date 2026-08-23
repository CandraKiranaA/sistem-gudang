@extends('layouts.app')

@section('title', 'Stock Out')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h3 class="fw-bold mb-1">
            📤 Stock Out
        </h3>

        <p class="text-muted mb-0">
            Daftar barang yang terjual
        </p>
    </div>

    <a
        href="{{ route('penjualan.create') }}"
        class="btn btn-primary"
    >
        + Buat Nota
    </a>

</div>


@if(session('success'))

    <div class="alert alert-success">
        {{ session('success') }}
    </div>

@endif


<div class="card shadow-sm">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>
                        <th>No. Nota</th>
                        <th>Tanggal</th>
                        <th>Customer</th>
                        <th>Jumlah Barang</th>
                        <th>Total</th>
                        <th width="150">Aksi</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse($penjualans as $penjualan)

                        <tr>

                            <td>
                                <strong>
                                    {{ $penjualan->nomor_nota }}
                                </strong>
                            </td>

                            <td>
                                {{ $penjualan->tanggal_penjualan->format('d/m/Y H:i') }}
                            </td>

                            <td>
                                {{ $penjualan->nama_customer }}
                            </td>

                            <td>
                                {{ $penjualan->details->count() }}
                            </td>

                            <td>
                                Rp
                                {{ number_format($penjualan->total, 0, ',', '.') }}
                            </td>

                            <td>

                                <a
                                    href="{{ route('penjualan.show', $penjualan->id) }}"
                                    class="btn btn-sm btn-outline-primary"
                                >
                                    Detail
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="text-center text-muted py-4"
                            >
                                Belum ada transaksi penjualan.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection