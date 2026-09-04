<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Ganti Password - Sistem Gudang
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
           PAGE WRAPPER
        ========================================================= */

        .password-page {

            min-height: 100vh;

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 30px 20px;
        }


        /* =========================================================
           MAIN CARD
        ========================================================= */

        .password-wrapper {

            width: 100%;

            max-width: 900px;

            min-height: 560px;

            display: grid;

            grid-template-columns:
                40% 60%;

            background-color: #ffffff;

            border-radius: 22px;

            overflow: hidden;

            box-shadow:
                0 20px 60px rgba(31, 41, 55, 0.10);

            border: 1px solid #e5e7eb;
        }


        /* =========================================================
           LEFT PANEL
        ========================================================= */

        .password-info {

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


        /* Dekorasi */

        .password-info::before {

            content: "";

            position: absolute;

            width: 210px;

            height: 210px;

            border-radius: 50%;

            background-color: rgba(212, 167, 0, 0.08);

            top: -90px;

            right: -80px;
        }


        .password-info::after {

            content: "";

            position: absolute;

            width: 150px;

            height: 150px;

            border-radius: 50%;

            background-color: rgba(212, 167, 0, 0.06);

            bottom: -65px;

            left: -60px;
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
           INFO CONTENT
        ========================================================= */

        .info-content {

            position: relative;

            z-index: 2;

            margin-top: 25px;
        }


        .lock-illustration {

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
                0 12px 30px rgba(212, 167, 0, 0.10);
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

            color: #6b7280;

            font-size: 14px;

            line-height: 1.7;

            max-width: 290px;
        }


        /* =========================================================
           INFO FOOTER
        ========================================================= */

        .info-footer {

            position: relative;

            z-index: 2;

            padding-top: 25px;
        }


        .security-item {

            display: flex;

            align-items: center;

            gap: 10px;

            margin-top: 10px;

            color: #6b7280;

            font-size: 12px;
        }


        .security-check {

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
           RIGHT FORM
        ========================================================= */

        .password-form-area {

            padding: 45px 50px;

            display: flex;

            flex-direction: column;

            justify-content: center;
        }


        .form-header {

            margin-bottom: 28px;
        }


        .form-title {

            margin: 0 0 7px 0;

            font-size: 25px;

            font-weight: 800;

            color: #111827;
        }


        .form-subtitle {

            margin: 0;

            color: #6b7280;

            font-size: 13px;
        }


        /* =========================================================
           ALERT
        ========================================================= */

        .alert {

            border-radius: 10px;

            border: none;

            font-size: 13px;
        }


        .alert-success {

            background-color: #ecfdf3;

            color: #166534;
        }


        .alert-danger {

            background-color: #fef2f2;

            color: #991b1b;
        }


        /* =========================================================
           FORM GROUP
        ========================================================= */

        .form-group-custom {

            margin-bottom: 19px;
        }


        .form-label {

            margin-bottom: 8px;

            font-size: 13px;

            font-weight: 700;

            color: #374151;
        }


        /* =========================================================
           INPUT WRAPPER
        ========================================================= */

        .password-input-wrapper {

            position: relative;
        }


        .password-input-wrapper .input-icon {

            position: absolute;

            left: 14px;

            top: 50%;

            transform: translateY(-50%);

            font-size: 16px;

            color: #9ca3af;

            pointer-events: none;

            z-index: 2;
        }


        .password-input {

            width: 100%;

            height: 48px;

            padding:
                10px
                45px
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
                box-shadow 0.2s ease;
        }


        .password-input::placeholder {

            color: #adb3bb;
        }


        .password-input:focus {

            border-color: #d4a700;

            box-shadow:
                0 0 0 3px rgba(212, 167, 0, 0.12);
        }


        /* =========================================================
           SHOW PASSWORD BUTTON
        ========================================================= */

        .toggle-password {

            position: absolute;

            right: 12px;

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
           PASSWORD HINT
        ========================================================= */

        .password-hint {

            margin-top: 7px;

            font-size: 11px;

            color: #9ca3af;
        }


        /* =========================================================
           BUTTON AREA
        ========================================================= */

        .button-area {

            display: flex;

            gap: 10px;

            margin-top: 10px;
        }


        .btn-cancel {

            height: 46px;

            flex: 1;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 10px;

            border: 1px solid #e5e7eb;

            background-color: #ffffff;

            color: #6b7280;

            text-decoration: none;

            font-size: 13px;

            font-weight: 600;

            transition:
                background-color 0.2s ease,
                border-color 0.2s ease,
                color 0.2s ease;
        }


        .btn-cancel:hover {

            background-color: #f9fafb;

            border-color: #d1d5db;

            color: #374151;
        }


        .btn-save {

            height: 46px;

            flex: 1.5;

            border: none;

            border-radius: 10px;

            background-color: #d4a700;

            color: #ffffff;

            font-size: 13px;

            font-weight: 700;

            cursor: pointer;

            transition:
                background-color 0.2s ease,
                transform 0.15s ease,
                box-shadow 0.2s ease;
        }


        .btn-save:hover {

            background-color: #b88f00;

            transform: translateY(-1px);

            box-shadow:
                0 5px 15px rgba(212, 167, 0, 0.20);
        }


        .btn-save:active {

            transform: translateY(0);
        }


        /* =========================================================
           BOTTOM NOTE
        ========================================================= */

        .form-note {

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 6px;

            margin-top: 20px;

            color: #9ca3af;

            font-size: 11px;

            text-align: center;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 800px) {

            .password-wrapper {

                max-width: 550px;

                grid-template-columns: 1fr;
            }


            .password-info {

                min-height: 270px;

                padding: 30px;
            }


            .info-content {

                margin-top: 20px;
            }


            .lock-illustration {

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


            .password-form-area {

                padding: 35px 30px 40px;
            }

        }


        @media (max-width: 480px) {

            .password-page {

                padding: 15px;
            }


            .password-wrapper {

                border-radius: 16px;
            }


            .password-info {

                padding: 25px;
            }


            .password-form-area {

                padding: 30px 22px;
            }


            .form-title {

                font-size: 22px;
            }


            .button-area {

                flex-direction: column;
            }


            .btn-cancel,
            .btn-save {

                width: 100%;

                flex: none;
            }

        }

    </style>

</head>


<body>


<div class="password-page">


    <div class="password-wrapper">


        {{-- =====================================================
             LEFT INFORMATION PANEL
        ====================================================== --}}

        <div class="password-info">


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

                <div class="lock-illustration">
                    🔐
                </div>


                <h1 class="info-title">
                    Lindungi Akun Anda
                </h1>


                <p class="info-description">
                    Perbarui password secara berkala untuk menjaga
                    keamanan akun dan data sistem gudang Anda.
                </p>

            </div>



            {{-- SECURITY INFORMATION --}}

            <div class="info-footer">

                <div class="security-item">

                    <div class="security-check">
                        ✓
                    </div>

                    <span>
                        Gunakan kombinasi password yang kuat
                    </span>

                </div>


                <div class="security-item">

                    <div class="security-check">
                        ✓
                    </div>

                    <span>
                        Jangan gunakan password yang mudah ditebak
                    </span>

                </div>

            </div>


        </div>



        {{-- =====================================================
             RIGHT FORM
        ====================================================== --}}

        <div class="password-form-area">


            {{-- HEADER --}}

            <div class="form-header">

                <h2 class="form-title">
                    🔑 Ganti Password
                </h2>

                <p class="form-subtitle">
                    Masukkan password lama dan password baru Anda.
                </p>

            </div>



            {{-- SUCCESS --}}

            @if (session('success'))

                <div class="alert alert-success mb-4">

                    ✓ {{ session('success') }}

                </div>

            @endif



            {{-- ERRORS --}}

            @if ($errors->any())

                <div class="alert alert-danger mb-4">

                    <div class="fw-semibold mb-1">
                        Periksa kembali data Anda:
                    </div>

                    <ul class="mb-0 ps-3">

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif



            {{-- FORM --}}

            <form
                action="/change-password"
                method="POST"
            >

                @csrf



                {{-- =================================================
                     PASSWORD LAMA
                ================================================== --}}

                <div class="form-group-custom">

                    <label
                        class="form-label"
                        for="current_password"
                    >
                        Password Lama
                    </label>


                    <div class="password-input-wrapper">

                        <span class="input-icon">
                            🔒
                        </span>


                        <input
                            id="current_password"
                            type="password"
                            name="current_password"
                            class="password-input"
                            placeholder="Masukkan password lama"
                            autocomplete="current-password"
                            required
                        >


                        <button
                            type="button"
                            class="toggle-password"
                            onclick="togglePassword(
                                'current_password',
                                this
                            )"
                            aria-label="Tampilkan password"
                        >
                            👁
                        </button>

                    </div>

                </div>



                {{-- =================================================
                     PASSWORD BARU
                ================================================== --}}

                <div class="form-group-custom">

                    <label
                        class="form-label"
                        for="password"
                    >
                        Password Baru
                    </label>


                    <div class="password-input-wrapper">

                        <span class="input-icon">
                            🔐
                        </span>


                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="password-input"
                            placeholder="Minimal 8 karakter"
                            autocomplete="new-password"
                            required
                        >


                        <button
                            type="button"
                            class="toggle-password"
                            onclick="togglePassword(
                                'password',
                                this
                            )"
                            aria-label="Tampilkan password"
                        >
                            👁
                        </button>

                    </div>


                    <div class="password-hint">
                        Gunakan minimal 8 karakter untuk password baru.
                    </div>

                </div>



                {{-- =================================================
                     KONFIRMASI PASSWORD
                ================================================== --}}

                <div class="form-group-custom">

                    <label
                        class="form-label"
                        for="password_confirmation"
                    >
                        Konfirmasi Password Baru
                    </label>


                    <div class="password-input-wrapper">

                        <span class="input-icon">
                            🔐
                        </span>


                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            class="password-input"
                            placeholder="Ulangi password baru"
                            autocomplete="new-password"
                            required
                        >


                        <button
                            type="button"
                            class="toggle-password"
                            onclick="togglePassword(
                                'password_confirmation',
                                this
                            )"
                            aria-label="Tampilkan password"
                        >
                            👁
                        </button>

                    </div>

                </div>



                {{-- =================================================
                     BUTTON
                ================================================== --}}

                <div class="button-area">


                    <a
                        href="/dashboard"
                        class="btn-cancel"
                    >
                        ← Batal
                    </a>


                    <button
                        type="submit"
                        class="btn-save"
                    >
                        🔒 Simpan Password
                    </button>


                </div>



                {{-- NOTE --}}

                <div class="form-note">

                    <span>
                        🛡️
                    </span>

                    <span>
                        Pastikan Anda mengingat password baru Anda.
                    </span>

                </div>


            </form>


        </div>


    </div>

</div>



{{-- =========================================================
     JAVASCRIPT
========================================================= --}}

<script>

    function togglePassword(inputId, button) {

        const input = document.getElementById(inputId);

        if (!input) {
            return;
        }


        if (input.type === "password") {

            input.type = "text";

            button.textContent = "🙈";

            button.setAttribute(
                "aria-label",
                "Sembunyikan password"
            );

        } else {

            input.type = "password";

            button.textContent = "👁";

            button.setAttribute(
                "aria-label",
                "Tampilkan password"
            );

        }

    }

</script>


</body>

</html>