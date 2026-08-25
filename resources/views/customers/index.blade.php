@extends('layouts.app')

@section('content')

<div class="container-fluid px-3 px-md-4 py-3">

    {{-- ===================================================== --}}
    {{-- HEADER --}}
    {{-- ===================================================== --}}

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>

            <div class="d-flex align-items-center gap-2 mb-1">

                <div class="page-icon">
                    👥
                </div>

                <h3 class="fw-bold mb-0 text-dark">
                    Laporan Customer
                </h3>

            </div>

            <p class="text-muted mb-0 ms-1">
                Kelola dan pantau data customer serta jumlah transaksi.
            </p>

        </div>


        {{-- ================================================= --}}
        {{-- BUTTON --}}
        {{-- ================================================= --}}

        <div class="d-flex gap-2 mt-3 mt-md-0">

            <a
                href="{{ route('customers.create') }}"
                class="btn btn-primary btn-add"
            >
                <span class="me-1">
                    ＋
                </span>

                Tambah Customer
            </a>

        </div>

    </div>


    {{-- ===================================================== --}}
    {{-- SUCCESS --}}
    {{-- ===================================================== --}}

    @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show custom-alert"
            role="alert"
        >

            <div class="d-flex align-items-center">

                <div class="alert-icon success-icon">
                    ✓
                </div>

                <div>

                    <strong>
                        Berhasil!
                    </strong>

                    <div>
                        {{ session('success') }}
                    </div>

                </div>

            </div>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- ===================================================== --}}
    {{-- ERROR --}}
    {{-- ===================================================== --}}

    @if(session('error'))

        <div
            class="alert alert-danger alert-dismissible fade show custom-alert"
            role="alert"
        >

            <div class="d-flex align-items-center">

                <div class="alert-icon danger-icon">
                    !
                </div>

                <div>

                    <strong>
                        Gagal!
                    </strong>

                    <div>
                        {{ session('error') }}
                    </div>

                </div>

            </div>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- ===================================================== --}}
    {{-- VALIDATION ERROR --}}
    {{-- ===================================================== --}}

    @if($errors->any())

        <div class="alert alert-danger custom-alert">

            <strong>
                Terjadi kesalahan.
            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- ===================================================== --}}
    {{-- SEARCH --}}
    {{-- ===================================================== --}}

    <div class="card border-0 shadow-sm search-card mb-3">

        <div class="card-body p-3">

            <form
                action="{{ route('customers.index') }}"
                method="GET"
            >

                <div class="row g-2 align-items-center">

                    <div class="col-md-7 col-lg-5">

                        <div class="search-wrapper">

                            <span class="search-icon">
                                🔍
                            </span>

                            <input
                                type="text"
                                name="search"
                                class="form-control search-input"
                                placeholder="Cari nama customer..."
                                value="{{ request('search') }}"
                            >

                        </div>

                    </div>


                    <div class="col-auto">

                        <button
                            type="submit"
                            class="btn btn-primary px-4"
                        >
                            Cari
                        </button>

                    </div>


                    @if(request('search'))

                        <div class="col-auto">

                            <a
                                href="{{ route('customers.index') }}"
                                class="btn btn-light border px-3"
                            >
                                Reset
                            </a>

                        </div>

                    @endif

                </div>

            </form>

        </div>

    </div>


    {{-- ===================================================== --}}
    {{-- TABLE --}}
    {{-- ===================================================== --}}

    <div class="card border-0 shadow-sm table-card">

        {{-- TABLE HEADER --}}

        <div class="card-header bg-white border-0 px-3 px-md-4 py-3">

            <div class="d-flex flex-wrap justify-content-between align-items-center">

                <div>

                    <h5 class="fw-bold mb-1">
                        Daftar Customer
                    </h5>

                    <small class="text-muted">
                        Data customer yang terdaftar dalam sistem.
                    </small>

                </div>


                @if($customers->total() > 0)

                    <div class="data-count mt-2 mt-md-0">

                        <span class="count-number">
                            {{ $customers->total() }}
                        </span>

                        <span class="count-label">
                            Customer
                        </span>

                    </div>

                @endif

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- TABLE BODY --}}
        {{-- ================================================= --}}

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table align-middle mb-0 modern-table">

                    <thead>

                        <tr>

                            <th
                                class="text-center"
                                style="width: 80px;"
                            >
                                No
                            </th>

                            <th>
                                Nama Customer
                            </th>

                            <th
                                class="text-center"
                                style="width: 220px;"
                            >
                                Total Transaksi
                            </th>

                            <th
                                class="text-center"
                                style="width: 150px;"
                            >
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($customers as $customer)

                            <tr>

                                {{-- NO --}}

                                <td class="text-center">

                                    <span class="row-number">

                                        {{ $customers->firstItem() + $loop->index }}

                                    </span>

                                </td>


                                {{-- NAMA CUSTOMER --}}

                                <td>

                                    <div class="customer-name">

                                        {{ $customer->nama_customer }}

                                    </div>

                                    @if($customer->no_telepon)

                                        <small class="customer-phone">

                                            {{ $customer->no_telepon }}

                                        </small>

                                    @endif

                                </td>


                                {{-- TOTAL TRANSAKSI --}}

                                <td class="text-center">

                                    <span class="transaction-badge">

                                        {{ number_format(
                                            $customer->transaksis_count ?? 0
                                        ) }}

                                    </span>

                                </td>


                                {{-- AKSI --}}

                                <td>

                                    <div class="action-buttons">

                                        {{-- DETAIL --}}

                                        <a
                                            href="{{ route(
                                                'customers.show',
                                                $customer
                                            ) }}"
                                            class="action-btn view-btn"
                                            title="Lihat detail"
                                        >
                                            👁️
                                        </a>


                                        {{-- EDIT --}}

                                        <a
                                            href="{{ route(
                                                'customers.edit',
                                                $customer
                                            ) }}"
                                            class="action-btn edit-btn"
                                            title="Edit customer"
                                        >
                                            ✏️
                                        </a>


                                        {{-- HAPUS --}}

                                        <form
                                            action="{{ route(
                                                'customers.destroy',
                                                $customer
                                            ) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm(
                                                'Apakah kamu yakin ingin menghapus customer ini?'
                                            )"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="action-btn delete-btn"
                                                title="Hapus customer"
                                            >
                                                🗑️
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="4"
                                    class="empty-state"
                                >

                                    <div class="empty-icon">
                                        👥
                                    </div>

                                    <h6 class="fw-bold mb-1">
                                        Belum Ada Customer
                                    </h6>

                                    <p class="text-muted mb-3">
                                        Belum ada customer yang terdaftar
                                        di dalam sistem.
                                    </p>

                                    <a
                                        href="{{ route('customers.create') }}"
                                        class="btn btn-primary btn-sm px-3"
                                    >
                                        ＋ Tambah Customer
                                    </a>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- PAGINATION --}}
        {{-- ================================================= --}}

        @if($customers->hasPages())

            <div class="card-footer bg-white border-0 px-3 px-md-4 py-3">

                <div class="d-flex flex-wrap justify-content-between align-items-center">

                    <div>

                        <small class="pagination-info">

                            Menampilkan

                            <strong>
                                {{ $customers->firstItem() }}
                            </strong>

                            sampai

                            <strong>
                                {{ $customers->lastItem() }}
                            </strong>

                            dari

                            <strong>
                                {{ $customers->total() }}
                            </strong>

                            customer

                        </small>

                    </div>


                    <div class="mt-2 mt-md-0">

                        {{ $customers->withQueryString()->links() }}

                    </div>

                </div>

            </div>

        @endif

    </div>

</div>


{{-- ========================================================= --}}
{{-- STYLE --}}
{{-- ========================================================= --}}

<style>

/* =========================================================
   GENERAL
========================================================= */

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


.btn {

    border-radius: 8px;
}


.btn-add {

    padding: 10px 18px;

    font-size: 14px;

    font-weight: 600;

    box-shadow:
        0 3px 10px rgba(13, 110, 253, 0.15);

    transition: all .2s ease;
}


.btn-add:hover {

    transform: translateY(-1px);
}


/* =========================================================
   ALERT
========================================================= */

.custom-alert {

    border: 0;

    border-radius: 10px;

    box-shadow:
        0 2px 8px rgba(0,0,0,.04);
}


.alert-icon {

    width: 36px;
    height: 36px;

    border-radius: 50%;

    display: flex;
    align-items: center;
    justify-content: center;

    margin-right: 12px;

    font-weight: 700;
}


.success-icon {

    background: #d1e7dd;

    color: #146c43;
}


.danger-icon {

    background: #f8d7da;

    color: #b02a37;
}


/* =========================================================
   SEARCH
========================================================= */

.search-card {

    border-radius: 10px;
}


.search-wrapper {

    position: relative;
}


.search-icon {

    position: absolute;

    left: 13px;

    top: 50%;

    transform: translateY(-50%);

    z-index: 2;

    font-size: 15px;

    opacity: .65;
}


.search-input {

    height: 44px;

    padding-left: 40px;

    border-radius: 8px;

    font-size: 14px;
}


/* =========================================================
   TABLE CARD
========================================================= */

.table-card {

    border-radius: 12px;

    overflow: hidden;
}


.data-count {

    background: #f1f5f9;

    padding: 7px 13px;

    border-radius: 20px;

    font-size: 13px;
}


.count-number {

    font-weight: 700;

    color: #0d6efd;
}


.count-label {

    color: #6c757d;

    margin-left: 3px;
}


/* =========================================================
   TABLE
========================================================= */

.modern-table {

    font-size: 15px;

    width: 100%;
}


.modern-table thead {

    background: #f8fafc;
}


.modern-table thead th {

    color: #475569;

    font-size: 13px;

    font-weight: 700;

    text-transform: uppercase;

    letter-spacing: .3px;

    padding: 16px 18px;

    border-bottom: 1px solid #e9ecef;

    white-space: nowrap;

    vertical-align: middle;
}


.modern-table tbody td {

    padding: 17px 18px;

    border-bottom: 1px solid #f1f3f5;

    vertical-align: middle;

    font-size: 15px;
}


.modern-table tbody tr {

    transition: background-color .15s ease;
}


.modern-table tbody tr:hover {

    background: #f8fbff;
}


.modern-table tbody tr:last-child td {

    border-bottom: 0;
}


/* =========================================================
   NOMOR
========================================================= */

.row-number {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    width: 32px;

    height: 32px;

    background: #f1f5f9;

    border-radius: 7px;

    font-size: 13px;

    font-weight: 600;

    color: #64748b;
}


/* =========================================================
   CUSTOMER
========================================================= */

.customer-name {

    font-size: 16px;

    font-weight: 600;

    color: #1e293b;
}


.customer-phone {

    display: block;

    margin-top: 3px;

    font-size: 12px;

    color: #94a3b8;
}


/* =========================================================
   TRANSAKSI
========================================================= */

.transaction-badge {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    min-width: 50px;

    padding: 7px 13px;

    background: #eef6ff;

    color: #0d6efd;

    border-radius: 7px;

    font-size: 14px;

    font-weight: 700;
}


/* =========================================================
   ACTION
========================================================= */

.action-buttons {

    display: flex;

    justify-content: center;

    gap: 6px;
}


.action-btn {

    width: 35px;

    height: 35px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    border: 0;

    border-radius: 7px;

    text-decoration: none;

    transition: all .15s ease;

    font-size: 14px;
}


/* VIEW */

.view-btn {

    background: #d1ecf1;
}


.view-btn:hover {

    background: #0dcaf0;

    transform: translateY(-1px);
}


/* EDIT */

.edit-btn {

    background: #fff3cd;
}


.edit-btn:hover {

    background: #ffc107;

    transform: translateY(-1px);
}


/* DELETE */

.delete-btn {

    background: #f8d7da;
}


.delete-btn:hover {

    background: #dc3545;

    transform: translateY(-1px);
}


/* =========================================================
   EMPTY
========================================================= */

.empty-state {

    text-align: center;

    padding: 70px 20px !important;
}


.empty-icon {

    width: 70px;

    height: 70px;

    display: flex;

    align-items: center;

    justify-content: center;

    margin: 0 auto 15px;

    background: #f1f5f9;

    border-radius: 50%;

    font-size: 31px;
}


/* =========================================================
   PAGINATION
========================================================= */

.pagination-info {

    font-size: 13px;

    color: #64748b;
}


.pagination-info strong {

    color: #334155;
}


.card-footer .pagination {

    margin-bottom: 0;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 768px) {

    .container-fluid {

        padding-left: 12px !important;

        padding-right: 12px !important;
    }


    .modern-table thead th {

        padding: 13px 10px;

        font-size: 12px;
    }


    .modern-table tbody td {

        padding: 14px 10px;

        font-size: 14px;
    }


    .customer-name {

        font-size: 15px;
    }

}

</style>

@endsection