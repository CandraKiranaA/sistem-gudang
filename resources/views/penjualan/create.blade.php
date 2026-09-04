@extends('layouts.app')

@section('title', 'Buat Nota')

@section('content')

<div class="penjualan-page">

    {{-- =========================================================
    HEADER
    ========================================================= --}}

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div class="d-flex align-items-center gap-3">

            <div class="page-icon">
                🧾
            </div>

            <div>

                <h3 class="page-title fw-bold mb-1">
                    Buat Nota
                </h3>

                <p class="page-subtitle mb-0">
                    Masukkan data penjualan customer
                </p>

            </div>

        </div>

    </div>


    {{-- =========================================================
    PESAN ERROR
    ========================================================= --}}

    @if(session('error'))

        <div class="alert alert-danger custom-alert">
            {{ session('error') }}
        </div>

    @endif


    @if($errors->any())

        <div class="alert alert-danger custom-alert">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form action="{{ route('penjualan.store') }}" method="POST" id="form-penjualan">

        @csrf


        {{-- =========================================================
        INFORMASI CUSTOMER
        ========================================================= --}}

        <div class="card nota-card mb-4">

            <div class="card-header nota-card-header">

                <div class="d-flex align-items-center gap-2">

                    <div class="section-icon">
                        👤
                    </div>

                    <div>

                        <h5 class="section-title mb-0">
                            Informasi Customer
                        </h5>

                        <small class="section-subtitle">
                            Informasi customer dan waktu transaksi
                        </small>

                    </div>

                </div>

            </div>


            <div class="card-body p-4">

                <div class="row g-3">

                    {{-- NAMA CUSTOMER --}}

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Nama Customer
                        </label>

                        <input
                            type="text"
                            name="nama_customer"
                            class="form-control input-tegas"
                            value="{{ old('nama_customer') }}"
                            placeholder="Contoh: Toko Jaya"
                            required
                        >

                    </div>


                    {{-- TANGGAL --}}

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Tanggal & Jam Penjualan
                        </label>

                        <input
                            type="datetime-local"
                            name="tanggal_penjualan"
                            id="tanggal_penjualan"
                            class="form-control input-tegas"
                            value="{{ old(
                                'tanggal_penjualan',
                                now()->timezone('Asia/Jakarta')->format('Y-m-d\TH:i')
                            ) }}"
                            required
                        >

                        <small class="form-help">
                            Waktu Indonesia Barat (WIB)
                        </small>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
        BARANG YANG DIBELI
        ========================================================= --}}

        <div class="card nota-card mb-4">

            <div class="card-header nota-card-header">

                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                    <div class="d-flex align-items-center gap-2">

                        <div class="section-icon">
                            📦
                        </div>

                        <div>

                            <h5 class="section-title mb-0">
                                Barang yang Dibeli
                            </h5>

                            <small class="section-subtitle">
                                Masukkan jumlah koli atau PCS yang dijual
                            </small>

                        </div>

                    </div>


                    <button
                        type="button"
                        class="btn btn-outline-gold btn-sm"
                        onclick="tambahBarang()"
                    >
                        + Tambah Barang
                    </button>

                </div>

            </div>


            <div class="card-body p-4">

                <div id="barang-container">

                    <div class="barang-row row g-2 mb-3 align-items-end">

                        {{-- BARANG --}}

                        <div class="col-lg-5 col-md-12">

                            <label class="form-label fw-semibold">
                                Barang
                            </label>

                            <select
                                name="barang_id[]"
                                class="form-select barang-select input-tegas"
                                required
                            >

                                <option value="">
                                    -- Pilih Barang --
                                </option>

                                @foreach($barangs as $barang)

                                    <option
                                        value="{{ $barang->id }}"
                                        data-harga="{{ $barang->barangMasuks->sortByDesc('tanggal_input')->first()?->harga_jual_pcs ?? 0 }}"
                                        data-koli="{{ $barang->pcs_per_koli }}"
                                        data-stok-koli="{{ $barang->stok_koli }}"
                                        data-stok-pcs="{{ $barang->stok_pcs }}"
                                    >

                                        {{ $barang->nama_barang }}
                                        — Stok: {{ $barang->stok_koli }} koli / {{ $barang->stok_pcs }} pcs

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- KOLI --}}

                        <div class="col-lg-2 col-md-4">

                            <label class="form-label fw-semibold">
                                Koli
                            </label>

                            <input
                                type="number"
                                name="jumlah_koli[]"
                                class="form-control jumlah-koli input-tegas angka-input"
                                value="0"
                                min="0"
                            >

                        </div>


                        {{-- PCS --}}

                        <div class="col-lg-2 col-md-4">

                            <label class="form-label fw-semibold">
                                PCS
                            </label>

                            <input
                                type="number"
                                name="jumlah_pcs[]"
                                class="form-control jumlah-pcs input-tegas angka-input"
                                value="0"
                                min="0"
                            >

                        </div>


                        {{-- HARGA PCS --}}

                        <div class="col-lg-2 col-md-4">

                            <label class="form-label fw-semibold">
                                Harga / PCS
                            </label>

                            <input
                                type="text"
                                class="form-control harga-display input-tegas harga-readonly"
                                value="Rp 0"
                                readonly
                            >

                        </div>


                        {{-- RESET --}}

                        <div class="col-lg-1 col-md-12">

                            <button
                                type="button"
                                class="btn btn-outline-danger w-100 btn-reset"
                                onclick="hapusBarang(this)"
                                title="Reset barang"
                            >
                                Reset
                            </button>

                        </div>

                    </div>

                </div>


                <div class="calculation-alert mt-3 mb-0">

                    <small>

                        <strong>Perhitungan:</strong>

                        Total PCS =
                        (Koli × PCS per Koli) + PCS tambahan.

                    </small>

                </div>

            </div>

        </div>


        {{-- =========================================================
        RINGKASAN PEMBAYARAN
        ========================================================= --}}

        <div class="card nota-card mb-4 payment-card">

            <div class="card-header nota-card-header">

                <div class="d-flex align-items-center gap-2">

                    <div class="section-icon">
                        💰
                    </div>

                    <div>

                        <h5 class="section-title mb-0">
                            Ringkasan Pembayaran
                        </h5>

                        <small class="section-subtitle">
                            Periksa total pembayaran sebelum menyimpan nota.
                        </small>

                    </div>

                </div>

            </div>


            <div class="card-body p-4">

                <div class="payment-summary">


                    {{-- SUBTOTAL --}}

                    <div class="payment-row">

                        <div class="payment-label">
                            Subtotal
                        </div>

                        <strong id="subtotal-display" class="payment-value">
                            Rp 0
                        </strong>

                    </div>


                    {{-- DISKON NOMINAL --}}

                    <div class="payment-row">

                        <div class="payment-label-box">

                            <label for="diskon" class="payment-label fw-semibold mb-1">
                                Diskon
                            </label>

                            <small class="form-help d-block">
                                Masukkan nominal potongan diskon dalam Rupiah.
                            </small>

                        </div>


                        <div class="diskon-input">

                            <div class="input-group">

                                <span class="input-group-text">
                                    Rp
                                </span>

                                <input
                                    type="number"
                                    name="diskon"
                                    id="diskon"
                                    class="form-control input-tegas text-end"
                                    value="{{ old('diskon', 0) }}"
                                    min="0"
                                    step="1"
                                    placeholder="0"
                                >

                            </div>

                        </div>

                    </div>


                    {{-- POTONGAN DISKON --}}

                    <div class="payment-row">

                        <div class="payment-label text-muted">
                            Potongan Diskon
                        </div>

                        <span
                            class="payment-value text-danger"
                            id="diskon-display"
                        >
                            - Rp 0
                        </span>

                    </div>


                    {{-- TOTAL --}}

                    <div class="payment-total-box">

                        <div>

                            <div class="payment-total-label">
                                TOTAL YANG HARUS DIBAYAR
                            </div>

                            <small class="form-help">
                                Setelah potongan diskon
                            </small>

                        </div>

                        <strong
                            class="payment-total-value"
                            id="total-display"
                        >
                            Rp 0
                        </strong>

                    </div>


                    {{-- PEMBAYARAN CUSTOMER --}}

                    <div class="payment-section">

                        <div class="payment-section-title">
                            Pembayaran Customer
                        </div>


                        {{-- BAYAR CASH --}}

                        <div class="payment-field">

                            <label
                                for="bayar_cash"
                                class="form-label fw-semibold"
                            >
                                Bayar Cash
                            </label>

                            <div class="input-group input-tegas-group">

                                <span class="input-group-text">
                                    Rp
                                </span>

                                <input
                                    type="number"
                                    name="bayar_cash"
                                    id="bayar_cash"
                                    class="form-control input-tegas"
                                    value="{{ old('bayar_cash', 0) }}"
                                    min="0"
                                    step="1"
                                    placeholder="0"
                                >

                            </div>

                            <small class="form-help">
                                Masukkan jumlah uang yang dibayarkan customer.
                            </small>

                        </div>


                        {{-- HUTANG --}}

                        <div class="payment-field hutang-field">

                            <label
                                for="hutang"
                                class="form-label fw-semibold"
                            >
                                Hutang
                            </label>

                            <div class="input-group input-tegas-group">

                                <span class="input-group-text">
                                    Rp
                                </span>

                                <input
                                    type="number"
                                    name="hutang"
                                    id="hutang"
                                    class="form-control input-tegas"
                                    value="0"
                                    readonly
                                >

                            </div>

                            <small
                                class="form-help"
                                id="hutang-keterangan"
                            >
                                Tidak ada hutang.
                            </small>

                        </div>

                    </div>


                    {{-- STATUS PEMBAYARAN --}}

                    <div
                        id="status-pembayaran"
                        class="alert alert-success payment-status mb-0"
                    >
                        ✓ Pembayaran lunas.
                    </div>


                </div>

            </div>

        </div>


        {{-- =========================================================
        BUTTON
        ========================================================= --}}

        <div class="d-flex justify-content-end gap-2 mb-4">

            <a
                href="{{ route('penjualan.index') }}"
                class="btn btn-secondary-custom px-4"
            >
                Batal
            </a>

            <button
                type="submit"
                class="btn btn-gold px-4"
            >
                💾 Simpan & Buat Nota
            </button>

        </div>

    </form>


    {{-- =========================================================
    STYLE
    ========================================================= --}}

    <style>

        /* =========================================================
           PAGE
        ========================================================= */

        .penjualan-page {
            color: #374151;
        }


        .page-title {
            color: #374151;
            letter-spacing: -0.3px;
        }


        .page-subtitle {
            color: #9ca3af;
            font-size: 14px;
        }


        .page-icon {
            width: 46px;
            height: 46px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            border-radius: 14px;

            background: linear-gradient(
                135deg,
                #fffbea,
                #fffdf7
            );

            border: 1px solid #f0e4ae;

            box-shadow:
                0 4px 12px rgba(212, 167, 0, .08);

            font-size: 21px;
        }


        /* =========================================================
           CARD
        ========================================================= */

        .nota-card {
            border: 1px solid #e8e9ec !important;
            border-radius: 16px !important;
            background: #ffffff;

            box-shadow:
                0 5px 18px rgba(17, 24, 39, .055) !important;

            overflow: hidden;
        }


        .nota-card-header {
            background: linear-gradient(
                135deg,
                #fffbea,
                #fffdf7
            );

            border-bottom: 1px solid #eee7c9 !important;

            padding: 17px 20px;
        }


        .section-icon {
            width: 38px;
            height: 38px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            border-radius: 11px;

            background: #ffffff;

            border: 1px solid #f0e4ae;

            box-shadow:
                0 3px 8px rgba(212, 167, 0, .07);

            font-size: 17px;
        }


        .section-title {
            color: #6f5a00;
            font-weight: 700;
        }


        .section-subtitle {
            color: #9ca3af;
            font-size: 13px;
        }


        /* =========================================================
           FORM
        ========================================================= */

        .form-label {
            color: #374151;
            margin-bottom: 7px;
        }


        .form-help {
            color: #9ca3af;
            font-size: 12px;
        }


        .input-tegas {

            min-height: 44px;

            border: 1px solid #dfe2e7 !important;

            border-radius: 10px;

            background-color: #ffffff;

            color: #374151;

            font-size: 14px;

            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background-color .2s ease;

            box-shadow: none;
        }


        .input-tegas:hover {
            border-color: #d4c47c !important;
        }


        .input-tegas:focus {

            border-color: #d9bc42 !important;

            box-shadow:
                0 0 0 3px rgba(212, 167, 0, .10) !important;

            outline: none;
        }


        select.input-tegas {

            cursor: pointer;

            padding-left: 12px;
        }


        .angka-input {

            text-align: center;

            font-weight: 600;
        }


        .harga-readonly {

            background-color: #f9fafb !important;

            color: #6b7280 !important;

            font-weight: 600;

            cursor: default;
        }


        /* =========================================================
           BUTTON
        ========================================================= */

        .btn-outline-gold {

            border: 1px solid #d9bc42;

            color: #a18200;

            background: #fffdf7;

            border-radius: 10px;

            font-weight: 600;

            transition: all .2s ease;
        }


        .btn-outline-gold:hover {

            background: #fffbea;

            border-color: #cbaa27;

            color: #8b7000;

            transform: translateY(-1px);
        }


        .btn-gold {

            border: 1px solid #d4a700;

            background: linear-gradient(
                135deg,
                #d9b52e,
                #c99f00
            );

            color: #ffffff;

            border-radius: 10px;

            font-weight: 600;

            box-shadow:
                0 4px 10px rgba(212, 167, 0, .16);

            transition: all .2s ease;
        }


        .btn-gold:hover {

            background: linear-gradient(
                135deg,
                #cdaa22,
                #b99000
            );

            color: #ffffff;

            transform: translateY(-1px);

            box-shadow:
                0 6px 14px rgba(212, 167, 0, .20);
        }


        .btn-secondary-custom {

            background: #f9fafb;

            border: 1px solid #e5e7eb;

            color: #6b7280;

            border-radius: 10px;

            font-weight: 600;

            transition: all .2s ease;
        }


        .btn-secondary-custom:hover {

            background: #f3f4f6;

            border-color: #d1d5db;

            color: #4b5563;
        }


        .btn-reset {

            min-height: 44px;

            border-radius: 10px;

            font-weight: 600;

            border-color: #e5b8b8;

            color: #b45353;

            background: #fffafa;

            transition: all .2s ease;
        }


        .btn-reset:hover {

            background: #fff3f3;

            border-color: #d99a9a;

            color: #a33d3d;
        }


        /* =========================================================
           BARANG
        ========================================================= */

        .barang-row {

            border: 1px solid #e8e9ec;

            border-radius: 12px;

            padding: 15px 10px;

            margin-left: 0;

            margin-right: 0;

            background: #ffffff;

            transition: all .2s ease;
        }


        .barang-row:hover {

            border-color: #dfcf7d;

            background: #fffef9;

            box-shadow:
                0 3px 10px rgba(17, 24, 39, .035);
        }


        .calculation-alert {

            padding: 12px 15px;

            background: #fffbea;

            border: 1px solid #f0e4ae;

            border-radius: 10px;

            color: #806900;
        }


        /* =========================================================
           PAYMENT
        ========================================================= */

        .payment-card .card-body {
            background: #ffffff;
        }


        .payment-summary {
            width: 100%;
        }


        .payment-row {

            display: grid;

            grid-template-columns: 1fr 260px;

            align-items: center;

            gap: 30px;

            width: 100%;

            min-height: 62px;

            padding: 14px 0;

            border-bottom: 1px solid #eeeeee;
        }


        .payment-label-box {
            min-width: 0;
        }


        .payment-label {

            color: #4b5563;

            font-size: 14px;
        }


        .payment-value {

            display: block;

            width: 100%;

            text-align: right;

            font-size: 15px;

            white-space: nowrap;

            color: #374151;
        }


        /* =========================================================
           DISKON
        ========================================================= */

        .diskon-input {

            width: 260px;

            justify-self: end;
        }


        .diskon-input .input-group {
            width: 100%;
        }


        .diskon-input .input-group-text {

            height: 44px;

            background: #f9fafb;

            border: 1px solid #dfe2e7;

            border-right: 0;

            font-weight: 700;

            color: #6b7280;

            border-radius: 10px 0 0 10px;
        }


        .diskon-input input {

            height: 44px;

            border-left: 0 !important;

            border-radius: 0 10px 10px 0;
        }


        /* =========================================================
           TOTAL
        ========================================================= */

        .payment-total-box {

            display: grid;

            grid-template-columns: 1fr 260px;

            align-items: center;

            gap: 30px;

            width: 100%;

            margin-top: 20px;

            padding: 20px 22px;

            background: linear-gradient(
                135deg,
                #fffbea,
                #fffdf7
            );

            border: 1px solid #eadb91;

            border-radius: 12px;
        }


        .payment-total-label {

            font-weight: 700;

            font-size: 14px;

            color: #6f5a00;
        }


        .payment-total-value {

            width: 100%;

            text-align: right;

            color: #a18200;

            font-size: 21px;

            white-space: nowrap;
        }


        /* =========================================================
           PAYMENT SECTION
        ========================================================= */

        .payment-section {

            width: 100%;

            margin-top: 24px;

            padding: 22px;

            background: #ffffff;

            border: 1px solid #e5e7eb;

            border-radius: 12px;
        }


        .payment-section-title {

            font-weight: 700;

            font-size: 15px;

            color: #4b5563;

            padding-bottom: 13px;

            margin-bottom: 20px;

            border-bottom: 1px solid #eeeeee;
        }


        .payment-field {
            width: 100%;
        }


        .payment-field + .payment-field {
            margin-top: 22px;
        }


        .payment-field .form-label {

            display: block;

            margin-bottom: 8px;
        }


        .payment-field .input-group {
            width: 100%;
        }


        .input-tegas-group {
            border-radius: 10px;
        }


        .input-tegas-group .input-group-text {

            width: 55px;

            min-width: 55px;

            justify-content: center;

            background: #f9fafb;

            border: 1px solid #dfe2e7;

            border-right: 0;

            font-weight: 700;

            color: #6b7280;

            border-radius: 10px 0 0 10px;
        }


        .input-tegas-group .input-tegas {

            border-left: 0 !important;

            border-radius: 0 10px 10px 0;
        }


        .input-tegas-group:focus-within .input-group-text {

            border-color: #d9bc42;

            background: #fffbea;

            color: #8b7000;
        }


        #bayar_cash,
        #hutang {
            height: 44px;
        }


        #bayar_cash {

            text-align: right;

            font-size: 15px;

            font-weight: 600;
        }


        #hutang {

            background-color: #f9fafb !important;

            font-weight: 700;

            text-align: right;

            cursor: not-allowed;
        }


        /* =========================================================
           STATUS
        ========================================================= */

        .payment-status {

            width: 100%;

            margin-top: 18px;

            padding: 13px 16px;

            font-size: 14px;

            border-radius: 10px;

            border-width: 1px;
        }


        /* =========================================================
           ALERT
        ========================================================= */

        .custom-alert {

            border-radius: 10px;

            border-width: 1px;

            font-size: 14px;
        }


        /* =========================================================
           TABLET
        ========================================================= */

        @media (max-width: 991px) {

            .payment-row {

                grid-template-columns: 1fr 220px;

                gap: 20px;
            }


            .payment-total-box {

                grid-template-columns: 1fr 220px;

                gap: 20px;
            }


            .diskon-input {

                width: 220px;
            }

        }


        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 576px) {

            .nota-card .card-body {

                padding: 18px !important;
            }


            .nota-card-header {

                padding: 15px 16px;
            }


            .page-title {

                font-size: 21px;
            }


            .payment-row {

                display: flex;

                flex-direction: column;

                align-items: stretch;

                gap: 9px;

                min-height: auto;
            }


            .payment-value {

                width: 100%;

                text-align: left;
            }


            .diskon-input {

                width: 100%;

                justify-self: auto;
            }


            .payment-total-box {

                display: flex;

                flex-direction: column;

                align-items: stretch;

                gap: 10px;

                padding: 17px;
            }


            .payment-total-value {

                width: 100%;

                text-align: left;

                font-size: 19px;
            }


            .payment-section {

                padding: 17px;
            }


            .barang-row {

                padding: 15px;
            }


            .page-icon {

                width: 42px;

                height: 42px;

                font-size: 19px;
            }

        }

    </style>


    {{-- =========================================================
    JAVASCRIPT
    ========================================================= --}}

    <script>

        /*
        |--------------------------------------------------------------------------
        | FORMAT RUPIAH
        |--------------------------------------------------------------------------
        */

        function formatRupiah(angka) {

            angka = Number(angka) || 0;

            return 'Rp ' +
                angka.toLocaleString('id-ID');

        }



        /*
        |--------------------------------------------------------------------------
        | HITUNG TOTAL
        |--------------------------------------------------------------------------
        */

        function hitungTotal() {

            let subtotal = 0;


            document
                .querySelectorAll('.barang-row')
                .forEach(row => {

                    const select =
                        row.querySelector('.barang-select');

                    const option =
                        select.options[select.selectedIndex];


                    const harga =
                        Number(
                            option?.dataset.harga || 0
                        );


                    const koli =
                        Number(
                            row.querySelector('.jumlah-koli').value || 0
                        );


                    const pcs =
                        Number(
                            row.querySelector('.jumlah-pcs').value || 0
                        );


                    const pcsPerKoli =
                        Number(
                            option?.dataset.koli || 1
                        );


                    const totalPcs =
                        (koli * pcsPerKoli) + pcs;


                    subtotal +=
                        totalPcs * harga;


                    const hargaDisplay =
                        row.querySelector('.harga-display');


                    if (hargaDisplay) {

                        hargaDisplay.value =
                            formatRupiah(harga);

                    }

                });



            /*
            |--------------------------------------------------------------------------
            | DISKON NOMINAL
            |--------------------------------------------------------------------------
            */

            let diskon =
                Number(
                    document.getElementById('diskon').value || 0
                );


            if (diskon < 0) {

                diskon = 0;

                document.getElementById('diskon').value = 0;

            }


            if (diskon > subtotal) {

                diskon = subtotal;

                document.getElementById('diskon').value =
                    Math.round(subtotal);

            }


            const total =
                Math.max(
                    0,
                    subtotal - diskon
                );


            document.getElementById(
                'subtotal-display'
            ).textContent =
                formatRupiah(subtotal);


            document.getElementById(
                'diskon-display'
            ).textContent =
                '- ' + formatRupiah(diskon);


            document.getElementById(
                'total-display'
            ).textContent =
                formatRupiah(total);


            hitungPembayaran(total);

        }



        /*
        |--------------------------------------------------------------------------
        | HITUNG PEMBAYARAN
        |--------------------------------------------------------------------------
        */

        function hitungPembayaran(total) {

            const bayarCashInput =
                document.getElementById('bayar_cash');

            const hutangInput =
                document.getElementById('hutang');

            const statusPembayaran =
                document.getElementById('status-pembayaran');

            const hutangKeterangan =
                document.getElementById('hutang-keterangan');


            let bayarCash =
                Number(
                    bayarCashInput.value || 0
                );


            if (bayarCash < 0) {

                bayarCash = 0;

                bayarCashInput.value = 0;

            }


            if (bayarCash > total) {

                bayarCash = total;

                bayarCashInput.value = total;

            }


            const hutang =
                Math.max(
                    0,
                    total - bayarCash
                );


            hutangInput.value =
                Math.round(hutang);



            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            if (total <= 0) {

                statusPembayaran.className =
                    'alert alert-secondary payment-status mb-0';

                statusPembayaran.textContent =
                    'Belum ada barang yang dipilih.';

                hutangKeterangan.textContent =
                    'Belum ada total pembayaran.';

            }

            else if (hutang <= 0) {

                statusPembayaran.className =
                    'alert alert-success payment-status mb-0';

                statusPembayaran.textContent =
                    '✓ Pembayaran lunas.';

                hutangKeterangan.textContent =
                    'Tidak ada hutang.';

            }

            else {

                statusPembayaran.className =
                    'alert alert-warning payment-status mb-0';

                statusPembayaran.textContent =
                    '⚠️ Pembayaran belum lunas. Customer masih memiliki hutang ' +
                    formatRupiah(hutang) +
                    '.';

                hutangKeterangan.textContent =
                    'Sisa hutang customer: ' +
                    formatRupiah(hutang);

            }

        }



        /*
        |--------------------------------------------------------------------------
        | TAMBAH BARANG
        |--------------------------------------------------------------------------
        */

        function tambahBarang() {

            const container =
                document.getElementById('barang-container');

            const firstRow =
                document.querySelector('.barang-row');


            const newRow =
                firstRow.cloneNode(true);


            newRow.querySelector('.barang-select').value = '';

            newRow.querySelector('.jumlah-koli').value = 0;

            newRow.querySelector('.jumlah-pcs').value = 0;

            newRow.querySelector('.harga-display').value = 'Rp 0';


            container.appendChild(newRow);


            hitungTotal();

        }



        /*
        |--------------------------------------------------------------------------
        | RESET / HAPUS BARANG
        |--------------------------------------------------------------------------
        */

        function hapusBarang(button) {

            const rows =
                document.querySelectorAll('.barang-row');


            if (rows.length <= 1) {

                const row =
                    button.closest('.barang-row');


                row.querySelector('.barang-select').value = '';

                row.querySelector('.jumlah-koli').value = 0;

                row.querySelector('.jumlah-pcs').value = 0;

                row.querySelector('.harga-display').value = 'Rp 0';


                hitungTotal();

                return;

            }


            button
                .closest('.barang-row')
                .remove();


            hitungTotal();

        }



        /*
        |--------------------------------------------------------------------------
        | PERUBAHAN BARANG
        |--------------------------------------------------------------------------
        */

        document.addEventListener(
            'change',
            function (event) {

                if (
                    event.target.classList.contains(
                        'barang-select'
                    )
                ) {

                    const select =
                        event.target;


                    const option =
                        select.options[
                            select.selectedIndex
                        ];


                    const harga =
                        Number(
                            option?.dataset.harga || 0
                        );


                    const row =
                        select.closest(
                            '.barang-row'
                        );


                    const display =
                        row.querySelector(
                            '.harga-display'
                        );


                    display.value =
                        formatRupiah(harga);


                    hitungTotal();

                }

            }
        );



        /*
        |--------------------------------------------------------------------------
        | INPUT JUMLAH / DISKON / CASH
        |--------------------------------------------------------------------------
        */

        document.addEventListener(
            'input',
            function (event) {

                if (

                    event.target.classList.contains(
                        'jumlah-koli'
                    )

                    ||

                    event.target.classList.contains(
                        'jumlah-pcs'
                    )

                    ||

                    event.target.id === 'diskon'

                    ||

                    event.target.id === 'bayar_cash'

                ) {

                    hitungTotal();

                }

            }
        );



        /*
        |--------------------------------------------------------------------------
        | HALAMAN SELESAI DIMUAT
        |--------------------------------------------------------------------------
        */

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                hitungTotal();

            }
        );

    </script>

</div>

@endsection