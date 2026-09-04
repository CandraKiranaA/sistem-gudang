@extends('layouts.app')

@section('title', 'Laporan Customer')

@section('content')

<style>

/* =========================================================
   LAPORAN CUSTOMER
   THEME:
   WHITE / SOFT GRAY / CREAM / GOLD
========================================================= */

.customer-page {
    width: 100%;
}


/* =========================================================
   PAGE HEADER
========================================================= */

.customer-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;

    gap: 20px;
    margin-bottom: 24px;
}

.customer-title-area {
    min-width: 0;
}

.customer-title-row {
    display: flex;
    align-items: center;
    gap: 11px;
}

.customer-page-icon {
    width: 40px;
    min-width: 40px;
    height: 40px;

    display: flex;
    align-items: center;
    justify-content: center;

    background:
        linear-gradient(
            135deg,
            #fff8d8,
            #fffbea
        );

    border: 1px solid #f0e4ae;
    border-radius: 11px;

    font-size: 18px;

    box-shadow:
        0 3px 8px rgba(212, 167, 0, 0.06);
}

.customer-title {
    margin: 0;

    color: #1f2937;

    font-size: 24px;
    font-weight: 750;

    letter-spacing: -0.4px;
}

.customer-description {
    margin: 6px 0 0 51px;

    color: #9ca3af;

    font-size: 12.5px;
}

.customer-breadcrumb {
    margin-top: 5px;
    margin-left: 51px;

    color: #9ca3af;

    font-size: 11.5px;
}

.customer-breadcrumb span {
    color: #c0a52b;
    font-weight: 600;
}


/* =========================================================
   ALERT
========================================================= */

.custom-alert {
    display: flex;
    align-items: flex-start;
    gap: 11px;

    padding: 13px 15px;

    margin-bottom: 15px;

    border-radius: 10px;

    font-size: 12px;

    box-shadow:
        0 3px 10px rgba(15, 23, 42, 0.025);
}

.custom-alert strong {
    display: block;
    margin-bottom: 2px;
}

.alert-success.custom-alert {
    color: #3f6212;

    background: #f7fbeF;

    border: 1px solid #dcebc2;
}

.alert-danger.custom-alert {
    color: #991b1b;

    background: #fff8f8;

    border: 1px solid #f0d4d4;
}


/* =========================================================
   SEARCH CARD
========================================================= */

.search-card {
    margin-bottom: 18px;

    background: #ffffff;

    border: 1px solid #e5e7eb;
    border-radius: 13px;

    box-shadow:
        0 3px 15px rgba(15, 23, 42, 0.035);
}

.search-card-body {
    padding: 15px 18px;
}

.search-layout {
    display: flex;
    align-items: center;
    gap: 10px;
}

.search-wrapper {
    position: relative;

    width: 360px;
    max-width: 100%;
}

.search-icon {
    position: absolute;

    left: 12px;
    top: 50%;

    transform: translateY(-50%);

    color: #aeb4bd;

    font-size: 13px;

    z-index: 2;

    pointer-events: none;
}

.search-input {
    width: 100%;
    height: 39px;

    padding: 7px 35px 7px 34px;

    background: #ffffff;

    border: 1px solid #dfe2e6;

    border-radius: 8px;

    color: #374151;

    font-size: 12.5px;

    outline: none;

    transition:
        border-color .2s ease,
        box-shadow .2s ease;
}

.search-input::placeholder {
    color: #adb3bb;
}

.search-input:hover {
    border-color: #d2d6dc;
}

.search-input:focus {
    border-color: #d4a700;

    box-shadow:
        0 0 0 3px rgba(212, 167, 0, 0.09);
}

.search-clear {
    position: absolute;

    right: 11px;
    top: 50%;

    transform: translateY(-50%);

    color: #b0b5bc;

    text-decoration: none;

    font-size: 12px;
}

.search-clear:hover {
    color: #a18200;
}


/* =========================================================
   BUTTON
========================================================= */

.search-btn {
    height: 39px;

    padding: 7px 17px;

    background: #d4a700;

    border: 1px solid #c49a00;

    border-radius: 8px;

    color: #ffffff !important;

    font-size: 12px;
    font-weight: 700;

    transition:
        background-color .2s ease,
        border-color .2s ease,
        transform .15s ease,
        box-shadow .2s ease;
}

.search-btn:hover {
    background: #b58e00;

    border-color: #a18200;

    transform: translateY(-1px);

    box-shadow:
        0 5px 12px rgba(212, 167, 0, 0.13);
}

.reset-btn {
    height: 39px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    padding: 7px 15px;

    background: #ffffff;

    border: 1px solid #dfe2e6;

    border-radius: 8px;

    color: #6b7280 !important;

    text-decoration: none;

    font-size: 12px;
    font-weight: 650;

    transition:
        background-color .2s ease,
        border-color .2s ease,
        color .2s ease;
}

.reset-btn:hover {
    background: #fffbea;

    border-color: #eadb91;

    color: #967900 !important;
}


/* =========================================================
   TABLE CARD
========================================================= */

.table-card {
    background: #ffffff;

    border: 1px solid #e5e7eb;

    border-radius: 14px;

    overflow: hidden;

    box-shadow:
        0 3px 15px rgba(15, 23, 42, 0.035);
}


/* =========================================================
   TABLE HEADER
========================================================= */

.table-card-header {
    display: flex;

    align-items: center;
    justify-content: space-between;

    gap: 15px;

    padding: 17px 20px;

    border-bottom: 1px solid #f0f1f3;
}

.table-heading {
    display: flex;
    align-items: center;

    gap: 11px;
}

.table-header-icon {
    width: 39px;
    min-width: 39px;
    height: 39px;

    display: flex;
    align-items: center;
    justify-content: center;

    background:
        linear-gradient(
            135deg,
            #fff8d8,
            #fffbea
        );

    border: 1px solid #f0e4ae;
    border-radius: 10px;

    font-size: 17px;
}

.table-title-area {
    min-width: 0;
}

.table-title {
    margin: 0;

    color: #1f2937;

    font-size: 15.5px;
    font-weight: 750;
}

.table-description {
    margin: 4px 0 0;

    color: #9ca3af;

    font-size: 11.5px;
}


/* =========================================================
   DATA COUNT
========================================================= */

.data-count {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 4px;

    min-height: 29px;

    padding: 5px 11px;

    background: #fffbea;

    border: 1px solid #f0e4ae;

    border-radius: 20px;

    white-space: nowrap;
}

.count-number {
    color: #967900;

    font-size: 11px;

    font-weight: 750;
}

.count-label {
    color: #a3a8b0;

    font-size: 10.5px;

    font-weight: 600;
}


/* =========================================================
   TABLE WRAPPER
========================================================= */

.table-wrapper {
    width: 100%;

    overflow-x: auto;

    -webkit-overflow-scrolling: touch;
}

.table-wrapper::-webkit-scrollbar {
    height: 6px;
}

.table-wrapper::-webkit-scrollbar-track {
    background: #f8f8f9;
}

.table-wrapper::-webkit-scrollbar-thumb {
    background: #d7d9dd;

    border-radius: 10px;
}

.table-wrapper::-webkit-scrollbar-thumb:hover {
    background: #c2c5ca;
}


/* =========================================================
   TABLE
========================================================= */

.modern-table {
    width: 100%;

    min-width: 760px;

    margin: 0;

    border-collapse: separate;
    border-spacing: 0;

    font-size: 12.5px;
}


/* =========================================================
   TABLE HEADER
========================================================= */

.modern-table thead th {
    padding: 12px 15px;

    background: #fafafa;

    color: #6b7280;

    border-bottom: 1px solid #e3e5e8;
    border-right: 1px solid #eeeeef;

    font-size: 10.5px;

    font-weight: 750;

    letter-spacing: .045em;

    text-transform: uppercase;

    white-space: nowrap;

    vertical-align: middle;
}

.modern-table thead th:first-child {
    border-left: 1px solid #eeeeef;
}


/* =========================================================
   TABLE BODY
========================================================= */

.modern-table tbody td {
    padding: 13px 15px;

    background: #ffffff;

    color: #4b5563;

    border-bottom: 1px solid #f0f1f3;
    border-right: 1px solid #f0f1f3;

    vertical-align: middle;

    white-space: nowrap;
}

.modern-table tbody td:first-child {
    border-left: 1px solid #f0f1f3;
}

.modern-table tbody tr {
    transition: background-color .15s ease;
}

.modern-table tbody tr:hover td {
    background: #fffdf6;
}

.modern-table tbody tr:last-child td {
    border-bottom: 0;
}


/* =========================================================
   ROW NUMBER
========================================================= */

.row-number {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    width: 29px;
    height: 29px;

    background: #f5f6f8;

    border: 1px solid #e8eaed;

    border-radius: 7px;

    color: #64748b;

    font-size: 10.5px;

    font-weight: 700;
}


/* =========================================================
   CUSTOMER
========================================================= */

.customer-cell {
    display: flex;

    align-items: center;

    gap: 10px;
}

.customer-avatar {
    width: 34px;
    min-width: 34px;
    height: 34px;

    display: flex;
    align-items: center;
    justify-content: center;

    background:
        linear-gradient(
            135deg,
            #fff8d8,
            #fffbea
        );

    border: 1px solid #f0e4ae;

    border-radius: 9px;

    color: #a18200;

    font-size: 14px;
}

.customer-name {
    color: #374151;

    font-size: 12.5px;

    font-weight: 700;
}


/* =========================================================
   TRANSACTION BADGE
========================================================= */

.transaction-badge {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    min-width: 90px;

    padding: 5px 10px;

    background: #fffbea;

    border: 1px solid #f0e4ae;

    border-radius: 7px;

    color: #967900;

    font-size: 10.5px;

    font-weight: 750;
}


/* =========================================================
   ACTION BUTTON
========================================================= */

.action-btn {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    width: 34px;
    height: 34px;

    border-radius: 8px;

    text-decoration: none;

    transition:
        background-color .2s ease,
        border-color .2s ease,
        color .2s ease,
        transform .15s ease,
        box-shadow .2s ease;
}

.view-btn {
    background: #fffbea;

    border: 1px solid #eadb91;

    color: #967900;
}

.view-btn:hover {
    background: #fff5c7;

    border-color: #d4a700;

    color: #806700;

    transform: translateY(-1px);

    box-shadow:
        0 4px 9px rgba(212, 167, 0, 0.08);
}


/* =========================================================
   EMPTY STATE
========================================================= */

.empty-state {
    padding: 60px 20px !important;

    text-align: center;

    background: #ffffff !important;
}

.empty-icon {
    width: 58px;
    height: 58px;

    display: flex;

    align-items: center;
    justify-content: center;

    margin: 0 auto 12px;

    background:
        linear-gradient(
            135deg,
            #fff8d8,
            #fffbea
        );

    border: 1px solid #f0e4ae;

    border-radius: 15px;

    font-size: 25px;
}

.empty-title {
    margin-bottom: 3px;

    color: #374151;

    font-size: 13px;

    font-weight: 750;
}

.empty-description {
    margin: 0;

    color: #a3a8b0;

    font-size: 11.5px;
}


/* =========================================================
   TABLE FOOTER / PAGINATION
========================================================= */

.table-footer {
    display: flex;

    align-items: center;
    justify-content: space-between;

    gap: 15px;

    padding: 12px 20px;

    background: #fcfcfd;

    border-top: 1px solid #f0f1f3;
}

.pagination-info {
    color: #9ca3af;

    font-size: 11.5px;
}

.pagination-info strong {
    color: #6b7280;

    font-weight: 700;
}


/* =========================================================
   PAGINATION BOOTSTRAP OVERRIDE
========================================================= */

.table-footer .pagination {
    margin: 0;
}

.table-footer .page-link {
    min-width: 31px;
    height: 31px;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    margin-left: 3px;

    padding: 5px 9px;

    border: 1px solid #e1e3e6;

    border-radius: 7px !important;

    background: #ffffff;

    color: #6b7280;

    font-size: 11px;

    box-shadow: none;
}

.table-footer .page-link:hover {
    background: #fffbea;

    border-color: #eadb91;

    color: #967900;
}

.table-footer .page-item.active .page-link {
    background: #d4a700;

    border-color: #d4a700;

    color: #ffffff;
}

.table-footer .page-item.disabled .page-link {
    background: #f8f9fa;

    color: #c1c5ca;

    border-color: #e8eaed;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 767px) {

    .customer-header {
        align-items: flex-start;

        flex-direction: column;

        gap: 14px;
    }

    .customer-title {
        font-size: 21px;
    }

    .customer-description {
        margin-left: 0;
    }

    .customer-breadcrumb {
        margin-left: 0;
    }

    .search-card-body {
        padding: 13px;
    }

    .search-layout {
        align-items: stretch;

        flex-direction: column;
    }

    .search-wrapper {
        width: 100%;
    }

    .search-btn,
    .reset-btn {
        width: 100%;
    }

    .table-card-header {
        align-items: flex-start;

        flex-direction: column;

        padding: 15px;
    }

    .data-count {
        align-self: flex-start;
    }

    .table-footer {
        align-items: flex-start;

        flex-direction: column;

        padding: 12px 15px;
    }

}


@media (max-width: 480px) {

    .customer-title {
        font-size: 20px;
    }

    .customer-page-icon {
        width: 37px;
        min-width: 37px;
        height: 37px;
    }

    .customer-description,
    .customer-breadcrumb {
        font-size: 11px;
    }

    .modern-table {
        min-width: 700px;
    }

}

</style>


<div class="customer-page">


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="customer-header">

        <div class="customer-title-area">

            <div class="customer-title-row">

                <div class="customer-page-icon">
                    👥
                </div>

                <h3 class="customer-title">
                    Laporan Customer
                </h3>

            </div>

            <p class="customer-description">
                Data customer berdasarkan transaksi Stock Out.
            </p>

            <div class="customer-breadcrumb">

                Home
                <span>/</span>
                Laporan Customer

            </div>

        </div>

    </div>



    {{-- =====================================================
         SUCCESS
    ====================================================== --}}

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show custom-alert">

            <div>
                <strong>Berhasil!</strong>

                <div>
                    {{ session('success') }}
                </div>
            </div>

            <button
                type="button"
                class="btn-close ms-auto"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif



    {{-- =====================================================
         ERROR
    ====================================================== --}}

    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show custom-alert">

            <div>
                <strong>Gagal!</strong>

                <div>
                    {{ session('error') }}
                </div>
            </div>

            <button
                type="button"
                class="btn-close ms-auto"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif



    {{-- =====================================================
         VALIDATION ERROR
    ====================================================== --}}

    @if($errors->any())

        <div class="alert alert-danger custom-alert">

            <div>

                <strong>
                    Terjadi kesalahan:
                </strong>

                <ul class="mb-0 mt-2">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        </div>

    @endif



    {{-- =====================================================
         SEARCH
    ====================================================== --}}

    <div class="search-card">

        <div class="search-card-body">

            <form
                action="{{ route('customers.index') }}"
                method="GET"
            >

                <div class="search-layout">


                    {{-- SEARCH INPUT --}}

                    <div class="search-wrapper">

                        <span class="search-icon">
                            🔍
                        </span>

                        <input
                            type="text"
                            name="search"
                            class="search-input"
                            placeholder="Cari nama customer..."
                            value="{{ request('search') }}"
                            autocomplete="off"
                        >


                        @if(request('search'))

                            <a
                                href="{{ route('customers.index') }}"
                                class="search-clear"
                                title="Hapus pencarian"
                            >
                                ✕
                            </a>

                        @endif

                    </div>



                    {{-- CARI --}}

                    <button
                        type="submit"
                        class="search-btn"
                    >
                        🔍 Cari
                    </button>



                    {{-- RESET --}}

                    @if(request('search'))

                        <a
                            href="{{ route('customers.index') }}"
                            class="reset-btn"
                        >
                            Reset
                        </a>

                    @endif


                </div>

            </form>

        </div>

    </div>



    {{-- =====================================================
         TABLE
    ====================================================== --}}

    <div class="table-card">


        {{-- =================================================
             TABLE HEADER
        ================================================== --}}

        <div class="table-card-header">

            <div class="table-heading">

                <div class="table-header-icon">
                    👥
                </div>

                <div class="table-title-area">

                    <h5 class="table-title">
                        Daftar Customer
                    </h5>

                    <p class="table-description">
                        Customer yang tercatat pada transaksi Stock Out.
                    </p>

                </div>

            </div>


            @if($customers->total() > 0)

                <div class="data-count">

                    <span class="count-number">
                        {{ number_format($customers->total()) }}
                    </span>

                    <span class="count-label">
                        Customer
                    </span>

                </div>

            @endif

        </div>



        {{-- =================================================
             TABLE
        ================================================== --}}

        <div class="table-wrapper">

            <table class="modern-table">

                <thead>

                    <tr>

                        <th
                            class="text-center"
                            style="width: 75px;"
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
                            style="width: 120px;"
                        >
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($customers as $customer)

                        <tr>


                            {{-- =================================
                                 NO
                            ================================== --}}

                            <td class="text-center">

                                <span class="row-number">

                                    {{ $customers->firstItem() + $loop->index }}

                                </span>

                            </td>



                            {{-- =================================
                                 CUSTOMER
                            ================================== --}}

                            <td>

                                <div class="customer-cell">

                                    <div class="customer-avatar">
                                        👤
                                    </div>

                                    <div class="customer-name">

                                        {{ $customer->nama_customer }}

                                    </div>

                                </div>

                            </td>



                            {{-- =================================
                                 TOTAL TRANSAKSI
                            ================================== --}}

                            <td class="text-center">

                                <span class="transaction-badge">

                                    {{ number_format(
                                        $customer->total_transaksi ?? 0,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                    transaksi

                                </span>

                            </td>



                            {{-- =================================
                                 AKSI
                            ================================== --}}

                            <td class="text-center">

                                <a
                                    href="{{ route(
                                        'customers.show',
                                        [
                                            'nama_customer' =>
                                                $customer->nama_customer
                                        ]
                                    ) }}"
                                    class="action-btn view-btn"
                                    title="Lihat transaksi customer"
                                >
                                    👁
                                </a>

                            </td>


                        </tr>

                    @empty


                        {{-- =================================
                             DATA KOSONG
                        ================================== --}}

                        <tr>

                            <td
                                colspan="4"
                                class="empty-state"
                            >

                                <div class="empty-icon">
                                    👥
                                </div>

                                <div class="empty-title">
                                    Belum Ada Customer
                                </div>

                                <p class="empty-description">
                                    Belum ada customer pada transaksi Stock Out.
                                </p>

                            </td>

                        </tr>


                    @endforelse

                </tbody>

            </table>

        </div>



        {{-- =================================================
             PAGINATION
        ================================================== --}}

        @if($customers->hasPages())

            <div class="table-footer">


                <div class="pagination-info">

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

                </div>


                <div>

                    {{ $customers->withQueryString()->links() }}

                </div>


            </div>

        @endif


    </div>


</div>

@endsection