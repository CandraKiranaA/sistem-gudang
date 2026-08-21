<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ganti Password - Sistem Gudang</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f6fa;
        }

        .password-card {
            max-width: 500px;
            margin: 60px auto;
            border: none;
            border-radius: 16px;
        }

        .form-control {
            padding: 12px;
            border-radius: 10px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card password-card shadow-sm p-4">

        <h3 class="fw-bold mb-2">
            🔑 Ganti Password
        </h3>

        <p class="text-muted mb-4">
            Gunakan password baru yang sulit ditebak.
        </p>


        @if (session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif


        @if ($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form action="/change-password" method="POST">

            @csrf

            <!-- PASSWORD LAMA -->

            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Password Lama
                </label>

                <input
                    type="password"
                    name="current_password"
                    class="form-control"
                    placeholder="Masukkan password lama"
                    required
                >

            </div>


            <!-- PASSWORD BARU -->

            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Password Baru
                </label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Minimal 8 karakter"
                    required
                >

            </div>


            <!-- KONFIRMASI -->

            <div class="mb-4">

                <label class="form-label fw-semibold">
                    Konfirmasi Password Baru
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    class="form-control"
                    placeholder="Ulangi password baru"
                    required
                >

            </div>


            <div class="d-flex gap-2">

                <a href="/dashboard"
                   class="btn btn-light w-50">
                    Batal
                </a>

                <button
                    type="submit"
                    class="btn btn-primary w-50">
                    Simpan Password
                </button>

            </div>

        </form>

    </div>

</div>

</body>

</html>