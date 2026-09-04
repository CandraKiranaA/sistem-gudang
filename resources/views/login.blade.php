<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Login - Sistem Gudang
    </title>


    {{-- Bootstrap --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <style>

        /* =========================================================
           GLOBAL
        ========================================================= */

        * {
            box-sizing: border-box;
        }


        html,
        body {
            margin: 0;
            padding: 0;

            min-height: 100%;
        }


        body {

            min-height: 100vh;

            background:
                radial-gradient(
                    circle at top left,
                    #fffbea 0%,
                    #f5f6fa 42%,
                    #eef0f5 100%
                );

            color: #1f2937;

            font-family:
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Roboto,
                Arial,
                sans-serif;
        }


        /* =========================================================
           PAGE
        ========================================================= */

        .login-page {

            min-height: 100vh;

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 30px 20px;
        }


        /* =========================================================
           MAIN WRAPPER
        ========================================================= */

        .login-wrapper {

            width: 100%;

            max-width: 900px;

            min-height: 540px;

            display: grid;

            grid-template-columns:
                40% 60%;

            background-color: #ffffff;

            border-radius: 22px;

            overflow: hidden;

            border: 1px solid #e5e7eb;

            box-shadow:
                0 20px 60px rgba(31, 41, 55, 0.10);
        }


        /* =========================================================
           LEFT PANEL
        ========================================================= */

        .login-info {

            position: relative;

            padding: 45px 38px;

            display: flex;

            flex-direction: column;

            justify-content: space-between;

            background:
                linear-gradient(
                    145deg,
                    #fffbea 0%,
                    #fffdf6 55%,
                    #ffffff 100%
                );

            border-right: 1px solid #f1f1f1;

            overflow: hidden;
        }


        /* =========================================================
           DECORATION
        ========================================================= */

        .login-info::before {

            content: "";

            position: absolute;

            width: 230px;

            height: 230px;

            border-radius: 50%;

            background-color:
                rgba(212, 167, 0, 0.08);

            top: -105px;

            right: -90px;
        }


        .login-info::after {

            content: "";

            position: absolute;

            width: 170px;

            height: 170px;

            border-radius: 50%;

            background-color:
                rgba(212, 167, 0, 0.06);

            bottom: -75px;

            left: -65px;
        }


        /* =========================================================
           BRAND
        ========================================================= */

        .brand {

            position: relative;

            z-index: 2;

            display: flex;

            align-items: center;
        }


        .brand-icon {

            width: 48px;

            height: 48px;

            min-width: 48px;

            display: flex;

            align-items: center;

            justify-content: center;

            margin-right: 12px;

            border-radius: 13px;

            background-color: #ffffff;

            border: 1px solid #f0df8a;

            font-size: 24px;

            box-shadow:
                0 5px 15px rgba(0, 0, 0, 0.05);
        }


        .brand-name {

            font-size: 16px;

            font-weight: 800;

            color: #1f2937;

            line-height: 1.2;
        }


        .brand-subtitle {

            margin-top: 3px;

            font-size: 10px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: 0.10em;

            color: #a18200;
        }


        /* =========================================================
           LEFT CONTENT
        ========================================================= */

        .info-content {

            position: relative;

            z-index: 2;

            margin-top: 25px;
        }


        .warehouse-icon {

            width: 100px;

            height: 100px;

            display: flex;

            align-items: center;

            justify-content: center;

            margin-bottom: 25px;

            border-radius: 28px;

            background-color: #ffffff;

            border: 1px solid #f1e4a8;

            font-size: 48px;

            box-shadow:
                0 12px 30px
                rgba(212, 167, 0, 0.10);
        }


        .info-title {

            margin: 0 0 12px 0;

            font-size: 28px;

            line-height: 1.2;

            font-weight: 800;

            color: #1f2937;
        }


        .info-description {

            margin: 0;

            max-width: 290px;

            color: #6b7280;

            font-size: 14px;

            line-height: 1.7;
        }


        /* =========================================================
           INFO FOOTER
        ========================================================= */

        .info-footer {

            position: relative;

            z-index: 2;

            padding-top: 25px;
        }


        .info-item {

            display: flex;

            align-items: center;

            gap: 10px;

            margin-top: 10px;

            color: #6b7280;

            font-size: 12px;
        }


        .info-check {

            width: 24px;

            height: 24px;

            min-width: 24px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            background-color: #fff5c7;

            color: #a18200;

            font-size: 12px;

            font-weight: 700;
        }


        /* =========================================================
           RIGHT LOGIN AREA
        ========================================================= */

        .login-form-area {

            padding: 45px 50px;

            display: flex;

            flex-direction: column;

            justify-content: center;
        }


        /* =========================================================
           HEADER
        ========================================================= */

        .form-header {

            margin-bottom: 28px;
        }


        .form-title {

            margin: 0 0 7px 0;

            font-size: 26px;

            font-weight: 800;

            color: #111827;
        }


        .form-subtitle {

            margin: 0;

            color: #6b7280;

            font-size: 13px;
        }


        /* =========================================================
           ERROR
        ========================================================= */

        .alert {

            border: none;

            border-radius: 10px;

            font-size: 13px;
        }


        .alert-danger {

            background-color: #fef2f2;

            color: #991b1b;
        }


        /* =========================================================
           FORM GROUP
        ========================================================= */

        .form-group-custom {

            margin-bottom: 20px;
        }


        .form-label {

            margin-bottom: 8px;

            font-size: 13px;

            font-weight: 700;

            color: #374151;
        }


        /* =========================================================
           INPUT
        ========================================================= */

        .input-wrapper {

            position: relative;
        }


        .input-icon {

            position: absolute;

            left: 14px;

            top: 50%;

            transform: translateY(-50%);

            font-size: 16px;

            color: #9ca3af;

            pointer-events: none;

            z-index: 2;
        }


        .form-control-custom {

            width: 100%;

            height: 48px;

            padding:
                10px
                14px
                10px
                42px;

            border: 1px solid #dfe3e8;

            border-radius: 10px;

            background-color: #ffffff;

            color: #1f2937;

            font-size: 14px;

            outline: none;

            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                background-color 0.2s ease;
        }


        .form-control-custom::placeholder {

            color: #adb3bb;
        }


        .form-control-custom:focus {

            border-color: #d4a700;

            box-shadow:
                0 0 0 3px
                rgba(212, 167, 0, 0.12);

            background-color: #ffffff;
        }


        /* =========================================================
           PASSWORD TOGGLE
        ========================================================= */

        .toggle-password {

            position: absolute;

            right: 10px;

            top: 50%;

            transform: translateY(-50%);

            width: 30px;

            height: 30px;

            display: flex;

            align-items: center;

            justify-content: center;

            border: none;

            background-color: transparent;

            color: #9ca3af;

            border-radius: 7px;

            cursor: pointer;

            font-size: 15px;

            transition:
                color 0.2s ease,
                background-color 0.2s ease;
        }


        .toggle-password:hover {

            color: #a18200;

            background-color: #fffbea;
        }


        /* =========================================================
           LOGIN BUTTON
        ========================================================= */

        .btn-login {

            width: 100%;

            height: 48px;

            border: none;

            border-radius: 10px;

            background-color: #d4a700;

            color: #ffffff;

            font-size: 14px;

            font-weight: 700;

            cursor: pointer;

            transition:
                background-color 0.2s ease,
                transform 0.15s ease,
                box-shadow 0.2s ease;
        }


        .btn-login:hover {

            background-color: #b88f00;

            transform: translateY(-1px);

            box-shadow:
                0 6px 18px
                rgba(212, 167, 0, 0.22);
        }


        .btn-login:active {

            transform: translateY(0);
        }


        /* =========================================================
           LOGIN ICON
        ========================================================= */

        .login-button-content {

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 8px;
        }


        /* =========================================================
           FOOTER
        ========================================================= */

        .login-footer {

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 6px;

            margin-top: 25px;

            color: #9ca3af;

            font-size: 11px;

            text-align: center;
        }


        /* =========================================================
           SECURITY BADGE
        ========================================================= */

        .security-badge {

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 6px;

            margin-top: 14px;

            color: #9ca3af;

            font-size: 11px;
        }


        .security-badge-icon {

            font-size: 12px;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 800px) {

            .login-wrapper {

                max-width: 550px;

                grid-template-columns: 1fr;
            }


            .login-info {

                min-height: 270px;

                padding: 30px;
            }


            .info-content {

                margin-top: 20px;
            }


            .warehouse-icon {

                width: 65px;

                height: 65px;

                margin-bottom: 15px;

                border-radius: 18px;

                font-size: 32px;
            }


            .info-title {

                font-size: 22px;
            }


            .info-description {

                max-width: 100%;
            }


            .info-footer {

                display: none;
            }


            .login-form-area {

                padding: 35px 30px 40px;
            }

        }


        @media (max-width: 480px) {

            .login-page {

                padding: 15px;
            }


            .login-wrapper {

                border-radius: 16px;
            }


            .login-info {

                padding: 25px;
            }


            .login-form-area {

                padding: 30px 22px 35px;
            }


            .form-title {

                font-size: 22px;
            }

        }

    </style>

</head>


<body>


<div class="login-page">


    <div class="login-wrapper">


        {{-- =====================================================
             LEFT PANEL
        ====================================================== --}}

        <div class="login-info">


            {{-- BRAND --}}

            <div class="brand">

                <div class="brand-icon">
                    🏪
                </div>

                <div>

                    <div class="brand-name">
                        Perabot Heri Grosir
                    </div>

                    <div class="brand-subtitle">
                        Sistem Gudang
                    </div>

                </div>

            </div>



            {{-- INFORMATION --}}

            <div class="info-content">

                <div class="warehouse-icon">
                    📦
                </div>


                <h1 class="info-title">
                    Selamat Datang
                </h1>


                <p class="info-description">
                    Kelola stok barang, transaksi, dan laporan
                    gudang dengan mudah melalui satu sistem.
                </p>

            </div>



            {{-- FEATURES --}}

            <div class="info-footer">

                <div class="info-item">

                    <div class="info-check">
                        ✓
                    </div>

                    <span>
                        Kelola data barang dengan mudah
                    </span>

                </div>


                <div class="info-item">

                    <div class="info-check">
                        ✓
                    </div>

                    <span>
                        Pantau stok masuk dan keluar
                    </span>

                </div>


                <div class="info-item">

                    <div class="info-check">
                        ✓
                    </div>

                    <span>
                        Laporan gudang lebih terorganisir
                    </span>

                </div>

            </div>


        </div>



        {{-- =====================================================
             RIGHT LOGIN FORM
        ====================================================== --}}

        <div class="login-form-area">


            {{-- HEADER --}}

            <div class="form-header">

                <h2 class="form-title">
                    👋 Login ke Sistem
                </h2>

                <p class="form-subtitle">
                    Masukkan akun Anda untuk melanjutkan.
                </p>

            </div>



            {{-- ERROR MESSAGE --}}

            @if ($errors->any())

                <div class="alert alert-danger mb-4">

                    <div class="fw-semibold mb-1">
                        Login gagal
                    </div>

                    <div>
                        {{ $errors->first() }}
                    </div>

                </div>

            @endif



            {{-- LOGIN FORM --}}

            <form
                action="/login"
                method="POST"
            >

                @csrf



                {{-- =================================================
                     EMAIL
                ================================================== --}}

                <div class="form-group-custom">

                    <label
                        class="form-label"
                        for="email"
                    >
                        Email
                    </label>


                    <div class="input-wrapper">

                        <span class="input-icon">
                            ✉️
                        </span>


                        <input
                            id="email"
                            type="email"
                            name="email"
                            class="form-control-custom"
                            placeholder="Masukkan email"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            required
                        >

                    </div>

                </div>



                {{-- =================================================
                     PASSWORD
                ================================================== --}}

                <div class="form-group-custom">

                    <label
                        class="form-label"
                        for="password"
                    >
                        Password
                    </label>


                    <div class="input-wrapper">

                        <span class="input-icon">
                            🔒
                        </span>


                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="form-control-custom"
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                            required
                        >


                        <button
                            type="button"
                            class="toggle-password"
                            onclick="togglePassword()"
                            aria-label="Tampilkan password"
                        >
                            👁
                        </button>

                    </div>

                </div>



                {{-- =================================================
                     BUTTON
                ================================================== --}}

                <button
                    type="submit"
                    class="btn-login"
                >

                    <span class="login-button-content">

                        <span>
                            🔐
                        </span>

                        <span>
                            Login
                        </span>

                    </span>

                </button>


            </form>



            {{-- SECURITY --}}

            <div class="security-badge">

                <span class="security-badge-icon">
                    🛡️
                </span>

                <span>
                    Akses aman untuk pengguna sistem gudang
                </span>

            </div>



            {{-- FOOTER --}}

            <div class="login-footer">

                <span>
                    © {{ date('Y') }}
                </span>

                <span>
                    Perabot Heri Grosir
                </span>

            </div>


        </div>


    </div>

</div>



{{-- =========================================================
     JAVASCRIPT
========================================================= --}}

<script>

    function togglePassword() {

        const password =
            document.getElementById('password');

        const button =
            document.querySelector('.toggle-password');


        if (!password || !button) {
            return;
        }


        if (password.type === 'password') {

            password.type = 'text';

            button.textContent = '🙈';

            button.setAttribute(
                'aria-label',
                'Sembunyikan password'
            );

        } else {

            password.type = 'password';

            button.textContent = '👁';

            button.setAttribute(
                'aria-label',
                'Tampilkan password'
            );

        }

    }

</script>


</body>

</html>