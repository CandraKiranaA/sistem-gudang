@extends('layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between mb-4">

        <div>
            <h3>Detail Barang Masuk</h3>
        </div>

        <a
            href="{{ route('barang-masuk.create') }}"
            class="btn btn-secondary"
        >
            Kembali
        </a>

    </div>

    <div class="card">

        <div class="card-body">

            <table class="table">

                <tr>
                    <th width="250">Tanggal Input</th>
                    <td>
                        {{ $barangMasuk->tanggal_input->format('d/m/Y') }}
                    </td>
                </tr>

                <tr>
                    <th>Kode Barang</th>
                    <td>
                        {{ $barangMasuk->barang->kode_barang }}
                    </td>
                </tr>

                <tr>
                    <th>Nama Barang</th>
                    <td>
                        {{ $barangMasuk->barang->nama_barang }}
                    </td>
                </tr>

                <tr>
                    <th>PCS / Koli</th>
                    <td>
                        {{ $barangMasuk->barang->pcs_per_koli }}
                    </td>
                </tr>

                <tr>
                    <th>Jumlah Koli</th>
                    <td>
                        {{ number_format($barangMasuk->jumlah_koli) }}
                    </td>
                </tr>

                <tr>
                    <th>Jumlah PCS</th>
                    <td>
                        {{ number_format($barangMasuk->jumlah_pcs) }}
                    </td>
                </tr>

                <tr>
                    <th>Harga Beli / Koli</th>
                    <td>
                        Rp {{ number_format(
                            $barangMasuk->harga_beli_koli,
                            0,
                            ',',
                            '.'
                        ) }}
                    </td>
                </tr>

                <tr>
                    <th>Harga Jual / Koli</th>
                    <td>
                        Rp {{ number_format(
                            $barangMasuk->harga_jual_koli,
                            0,
                            ',',
                            '.'
                        ) }}
                    </td>
                </tr>

                <tr>
                    <th>Harga Jual / PCS</th>
                    <td>
                        Rp {{ number_format(
                            $barangMasuk->harga_jual_pcs,
                            0,
                            ',',
                            '.'
                        ) }}
                    </td>
                </tr>

            </table>

        </div>

    </div>

</div>

@endsection