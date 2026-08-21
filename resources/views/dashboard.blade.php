@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="fw-bold mb-1">Dashboard</h2>

        <p class="text-muted mb-0">
            Selamat datang, {{ Auth::user()->name }} 👋
        </p>
    </div>

</div>


<!-- STATISTIK -->

<div class="row g-4">

    <div class="col-md-3">

        <div class="card shadow-sm p-4">

            <p class="text-muted mb-2">
                📦 Total Barang
            </p>

            <h2 class="fw-bold mb-0">
                0
            </h2>

        </div>

    </div>


    <div class="col-md-3">

        <div class="card shadow-sm p-4">

            <p class="text-muted mb-2">
                📥 Barang Masuk
            </p>

            <h2 class="fw-bold mb-0">
                0
            </h2>

        </div>

    </div>


    <div class="col-md-3">

        <div class="card shadow-sm p-4">

            <p class="text-muted mb-2">
                📤 Barang Keluar
            </p>

            <h2 class="fw-bold mb-0">
                0
            </h2>

        </div>

    </div>


    <div class="col-md-3">

        <div class="card shadow-sm p-4">

            <p class="text-muted mb-2">
                🧾 Total Nota
            </p>

            <h2 class="fw-bold mb-0">
                0
            </h2>

        </div>

    </div>

</div>


<!-- WELCOME -->

<div class="card shadow-sm mt-4 p-4">

    <h5 class="fw-bold">
        Sistem Gudang
    </h5>

    <p class="text-muted mb-0">
        Gunakan menu di sebelah kiri untuk mengelola
        data barang, barang masuk, nota penjualan,
        dan barang keluar.
    </p>

</div>

@endsection