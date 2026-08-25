@extends('layouts.app')

@section('content')

<div class="container">

    {{-- ===================================================== --}}
    {{-- HEADER --}}
    {{-- ===================================================== --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="mb-1">
                Edit Customer
            </h3>

            <p class="text-muted mb-0">
                Perbarui data customer yang sudah terdaftar.
            </p>

        </div>

        <a
            href="{{ route('customers.index') }}"
            class="btn btn-outline-secondary"
        >
            ← Kembali
        </a>

    </div>


    {{-- ===================================================== --}}
    {{-- ERROR --}}
    {{-- ===================================================== --}}

    @if($errors->any())

        <div class="alert alert-danger">

            <strong>
                Data belum dapat diperbarui.
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
    {{-- FORM --}}
    {{-- ===================================================== --}}

    <form
        action="{{ route('customers.update', $customer) }}"
        method="POST"
    >

        @csrf

        @method('PUT')


        <div class="card shadow-sm">

            {{-- CARD HEADER --}}

            <div class="card-header bg-white">

                <h5 class="mb-1">
                    Informasi Customer
                </h5>

                <small class="text-muted">
                    Ubah data customer sesuai informasi terbaru.
                </small>

            </div>


            {{-- BODY --}}

            <div class="card-body">

                <div class="row g-4">


                    {{-- NAMA --}}

                    <div class="col-md-6">

                        <label
                            for="nama_customer"
                            class="form-label fw-semibold"
                        >
                            Nama Customer
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            id="nama_customer"
                            name="nama_customer"
                            class="form-control @error('nama_customer') is-invalid @enderror"
                            placeholder="Contoh: Ahmad"
                            value="{{ old(
                                'nama_customer',
                                $customer->nama_customer
                            ) }}"
                            maxlength="255"
                            required
                        >

                        @error('nama_customer')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                        <small class="text-muted">
                            Ubah nama customer jika diperlukan.
                        </small>

                    </div>


                    {{-- TELEPON --}}

                    <div class="col-md-6">

                        <label
                            for="no_telepon"
                            class="form-label fw-semibold"
                        >
                            Nomor Telepon
                        </label>

                        <input
                            type="text"
                            id="no_telepon"
                            name="no_telepon"
                            class="form-control @error('no_telepon') is-invalid @enderror"
                            placeholder="Contoh: 081234567890"
                            value="{{ old(
                                'no_telepon',
                                $customer->no_telepon
                            ) }}"
                            maxlength="30"
                        >

                        @error('no_telepon')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                        <small class="text-muted">
                            Nomor telepon customer.
                        </small>

                    </div>


                    {{-- ALAMAT --}}

                    <div class="col-12">

                        <label
                            for="alamat"
                            class="form-label fw-semibold"
                        >
                            Alamat
                        </label>

                        <textarea
                            id="alamat"
                            name="alamat"
                            class="form-control @error('alamat') is-invalid @enderror"
                            rows="4"
                            placeholder="Masukkan alamat customer..."
                        >{{ old(
                            'alamat',
                            $customer->alamat
                        ) }}</textarea>

                        @error('alamat')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>


                {{-- INFORMASI --}}

                <div class="alert alert-info mt-4 mb-0">

                    <div class="d-flex">

                        <div class="me-2">
                            ℹ️
                        </div>

                        <div>

                            <strong>
                                Data Transaksi
                            </strong>

                            <div class="small mt-1">
                                Jumlah transaksi tidak perlu diubah secara
                                manual karena akan dihitung otomatis dari
                                data transaksi customer.
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- FOOTER --}}

            <div class="card-footer bg-white">

                <div class="d-flex justify-content-end gap-2">

                    <a
                        href="{{ route('customers.index') }}"
                        class="btn btn-light border"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary px-4"
                    >
                        Simpan Perubahan
                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection