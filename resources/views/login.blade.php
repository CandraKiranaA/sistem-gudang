<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Sistem Gudang</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6fa;
            min-height: 100vh;
        }

        .login-wrapper {
            min-height: 100vh;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            border: none;
            border-radius: 18px;
        }

        .logo {
            width: 65px;
            height: 65px;
            background: #eef2ff;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin: 0 auto 20px;
        }

        .form-control {
            padding: 12px 14px;
            border-radius: 10px;
        }

        .form-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.15);
        }

        .btn-login {
            padding: 12px;
            border-radius: 10px;
            background: #4f46e5;
            border: none;
            font-weight: 600;
        }

        .btn-login:hover {
            background: #4338ca;
        }

        .system-title {
            font-weight: 700;
            color: #222;
        }

        .subtitle {
            color: #777;
            font-size: 14px;
        }
    </style>
</head>

<body>

<div class="container login-wrapper d-flex align-items-center justify-content-center">

    <div class="card login-card shadow-sm p-4 p-md-5">

        <!-- LOGO -->
        <div class="logo">
            📦
        </div>


        <!-- TITLE -->
        <div class="text-center mb-4">

            <h3 class="system-title mb-2">
                Sistem Gudang
            </h3>

            <p class="subtitle mb-0">
                Silakan login untuk mengakses sistem
            </p>

        </div>


        <!-- ERROR -->
        @if ($errors->any())

            <div class="alert alert-danger py-2">
                {{ $errors->first() }}
            </div>

        @endif


        <!-- LOGIN FORM -->
        <form action="/login" method="POST">

            @csrf

            <!-- EMAIL -->
            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Masukkan email"
                    value="{{ old('email') }}"
                    required
                >

            </div>


            <!-- PASSWORD -->
            <div class="mb-4">

                <label class="form-label fw-semibold">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Masukkan password"
                    required
                >

            </div>


            <!-- BUTTON -->
            <button
                type="submit"
                class="btn btn-login btn-primary w-100"
            >
                Login
            </button>

        </form>


        <!-- FOOTER -->
        <div class="text-center mt-4">

            <small class="text-muted">
                Sistem Gudang &copy; {{ date('Y') }}
            </small>

        </div>

    </div>

</div>

</body>

</html>