@extends('layouts.app')

@section('title', 'Laporan Barang')

@section('content')

    <style>
        .page-header {
            margin-bottom: 25px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 4px;
        }

        .breadcrumb-text {
            font-size: 13px;
            color: #9ca3af;
        }

        .report-card {
            background: #ffffff;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        .report-toolbar {
            padding: 20px 20px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .download-btn {
            background-color: #22c55e;
            border: none;
            color: white;
            padding: 9px 18px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: 0.2s;
        }

        .download-btn:hover {
            background-color: #16a34a;
            color: white;
        }

        .search-box {
            position: relative;
            width: 250px;
        }

        .search-box input {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 5px;
            padding: 8px 12px;
            font-size: 13px;
            outline: none;
        }

        .search-box input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.08);
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .report-table {
            width: 100%;
            margin: 0;
            border-collapse: collapse;
            font-size: 13px;
        }

        .report-table thead th {
            background-color: #f9fafb;
            color: #374151;
            font-weight: 600;
            border: 1px solid #e5e7eb;
            padding: 12px 10px;
            vertical-align: middle;
            white-space: nowrap;
        }

        .report-table tbody td {
            border: 1px solid #e5e7eb;
            padding: 11px 10px;
            color: #4b5563;
            vertical-align: middle;
            white-space: nowrap;
        }

        .report-table tbody tr:hover {
            background-color: #f9fafb;
        }

        .number-cell {
            text-align: center;
        }

        .name-cell {
            font-weight: 500;
            color: #374151 !important;
        }

        .stock-header {
            text-align: center;
            background-color: #f3f4f6 !important;
        }

        .stock-subheader {
            text-align: center;
            font-size: 12px;
        }

        .profit {
            font-weight: 600;
            color: #16a34a !important;
            text-align: right;
        }

        .detail-btn {
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #0ea5e9;
            color: white;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            transition: 0.2s;
        }

        .detail-btn:hover {
            background-color: #0284c7;
            color: white;
        }

        .empty-data {
            padding: 35px !important;
            text-align: center;
            color: #9ca3af !important;
        }

        .table-footer {
            padding: 15px 20px;
            color: #6b7280;
            font-size: 13px;
            border-top: 1px solid #e5e7eb;
        }

        @media (max-width: 768px) {

            .content {
                padding: 20px;
            }

            .report-toolbar {
                align-items: stretch;
            }

            .search-box {
                width: 100%;
            }

            .download-btn {
                width: 100%;
                text-align: center;
            }

        }
    </style>


    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div class="page-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h3 class="page-title">
                    Laporan Barang
                </h3>

                <div class="breadcrumb-text">
                    Home / Laporan Barang
                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- CARD LAPORAN --}}
    {{-- ========================================================= --}}

    <div class="report-card">


        {{-- ===================================================== --}}
        {{-- TOOLBAR --}}
        {{-- ===================================================== --}}

        <div class="report-toolbar">


            {{-- DOWNLOAD --}}

            <div>

                {{-- Nanti kita sambungkan ke export Excel/PDF --}}

                <a href="{{ route('laporan.export.excel') }}" class="download-btn">
                    ⬇ Download Excel
                </a>

            </div>


            {{-- SEARCH --}}

            <form action="{{ route('laporan.barang.index') }}" method="GET" class="search-box">

                <input type="text" name="search" placeholder="Search..." value="{{ $search }}">

            </form>

        </div>


        {{-- ===================================================== --}}
        {{-- TABLE --}}
        {{-- ===================================================== --}}

        <div class="table-wrapper">

            <table class="report-table">


                {{-- ================================================= --}}
                {{-- HEADER UTAMA --}}
                {{-- ================================================= --}}

                <thead>

                    <tr>

                        <th rowspan="2" class="text-center">
                            No
                        </th>


                        <th rowspan="2">
                            Nama Barang
                        </th>


                        <th rowspan="2" class="text-center">
                            Satuan
                        </th>


                        <th colspan="2" class="stock-header">
                            Barang Masuk
                        </th>


                        <th colspan="2" class="stock-header">
                            Barang Keluar
                        </th>


                        <th colspan="2" class="stock-header">
                            Sisa Barang
                        </th>


                        <th rowspan="2" class="text-center">
                            Keuntungan
                        </th>


                        <th rowspan="2" class="text-center">
                            Detail
                        </th>

                    </tr>


                    {{-- ================================================= --}}
                    {{-- SUB HEADER --}}
                    {{-- ================================================= --}}

                    <tr>

                        <th class="stock-subheader">
                            Koli
                        </th>

                        <th class="stock-subheader">
                            Pcs
                        </th>


                        <th class="stock-subheader">
                            Koli
                        </th>

                        <th class="stock-subheader">
                            Pcs
                        </th>


                        <th class="stock-subheader">
                            Koli
                        </th>

                        <th class="stock-subheader">
                            Pcs
                        </th>

                    </tr>

                </thead>


                {{-- ================================================= --}}
                {{-- BODY --}}
                {{-- ================================================= --}}

                <tbody>

                    @forelse($laporan as $index => $data)

                                    <tr>


                                        {{-- NO --}}

                                        <td class="number-cell">

                                            {{ $index + 1 }}

                                        </td>


                                        {{-- NAMA BARANG --}}

                                        <td class="name-cell">

                                            {{ $data['nama_barang'] }}

                                        </td>


                                        {{-- SATUAN --}}

                                        <td class="number-cell">

                                            {{ $data['satuan'] }}

                                        </td>


                                        {{-- ================================================= --}}
                                        {{-- BARANG MASUK --}}
                                        {{-- ================================================= --}}

                                        <td class="number-cell">

                                            {{ number_format(
                            $data['barang_masuk_koli']
                        ) }}

                                        </td>


                                        <td class="number-cell">

                                            {{ number_format(
                            $data['barang_masuk_pcs']
                        ) }}

                                        </td>


                                        {{-- ================================================= --}}
                                        {{-- BARANG KELUAR --}}
                                        {{-- ================================================= --}}

                                        <td class="number-cell">

                                            {{ number_format(
                            $data['barang_keluar_koli']
                        ) }}

                                        </td>


                                        <td class="number-cell">

                                            {{ number_format(
                            $data['barang_keluar_pcs']
                        ) }}

                                        </td>


                                        {{-- ================================================= --}}
                                        {{-- SISA --}}
                                        {{-- ================================================= --}}

                                        <td class="number-cell">

                                            {{ number_format(
                            $data['sisa_koli']
                        ) }}

                                        </td>


                                        <td class="number-cell">

                                            {{ number_format(
                            $data['sisa_pcs']
                        ) }}

                                        </td>


                                        {{-- ================================================= --}}
                                        {{-- KEUNTUNGAN --}}
                                        {{-- ================================================= --}}

                                        <td class="profit">

                                            Rp
                                            {{ number_format(
                            $data['keuntungan'],
                            0,
                            ',',
                            '.'
                        ) }}

                                        </td>


                                        {{-- ================================================= --}}
                                        {{-- DETAIL --}}
                                        {{-- ================================================= --}}

                                        <td class="text-center">

                                            <a href="{{ route(
                            'laporan.barang.show',
                            $data['id']
                        ) }}" class="detail-btn" title="Lihat Detail">
                                                👁
                                            </a>

                                        </td>

                                    </tr>


                    @empty

                        <tr>

                            <td colspan="11" class="empty-data">

                                Belum ada data laporan barang.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- ===================================================== --}}
        {{-- FOOTER --}}
        {{-- ===================================================== --}}

        <div class="table-footer">

            Menampilkan
            <strong>{{ $laporan->count() }}</strong>
            data barang

        </div>

    </div>

@endsection