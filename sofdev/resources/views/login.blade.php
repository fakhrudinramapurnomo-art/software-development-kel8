<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk ke Akun</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            height: 100%;
            font-family: 'Inter', system-ui, sans-serif;
            background: #ffffff;
            /* Latar belakang putih bersih penuh */
            color: #09090b;
            overflow-x: hidden;
        }

        /* Mengetengahkan seluruh form login di tengah layar */
        .wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 24px;
        }

        /* Area Form utama login */
        .form-area {
            max-width: 360px;
            width: 100%;
            margin: 0 auto;
        }

        .form-area h1 {
            font-size: 2rem;
            font-weight: 600;
            color: #09090b;
            margin-bottom: 6px;
            letter-spacing: -0.03em;
            text-align: center;
        }

        .form-area .tagline {
            font-size: 0.95rem;
            color: #71717a;
            margin-bottom: 32px;
            text-align: center;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #ef4444;
            border-radius: 8px;
            padding: 12px;
            font-size: 0.88rem;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e4e4e7;
            border-radius: 8px;
            font-size: 0.95rem;
            color: #09090b;
            background: #fff;
            outline: none;
            transition: border-color 0.15s;
        }

        input::placeholder {
            color: #a1a1aa;
        }

        input:focus {
            border-color: #09090b;
        }

        .input-error {
            border-color: #ef4444 !important;
        }

        .error-msg {
            color: #ef4444;
            font-size: 0.8rem;
            margin-top: 4px;
        }

        .btn-login {
            width: 100%;
            margin-top: 8px;
            padding: 14px;
            background: #09090b;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.15s;
        }

        .btn-login:hover {
            background: #27272a;
        }

        /* Gaya teks untuk link daftar akun baru */
        .register-link {
            text-align: center;
            font-size: 0.9rem;
            color: #71717a;
            margin-top: 24px;
        }

        .register-link a {
            color: #09090b;
            font-weight: 600;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .terms-text {
            font-size: 0.8rem;
            color: #71717a;
            text-align: center;
            margin-top: 40px;
            line-height: 1.5;
        }

        .terms-text a {
            color: #71717a;
            text-decoration: underline;
        }

        .alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #16a34a;
            border-radius: 8px;
            padding: 12px;
            font-size: 0.88rem;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="wrapper">

        <div class="form-area">
            @if (session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert-error">{{ session('error') }}</div>
            @endif
            <h1>Masuk ke akun</h1>
            <p class="tagline">Masukkan email dan password Anda untuk melanjutkan</p>

            @if (session('error'))
                <div class="alert-error">{{ session('error') }}</div>
            @endif

            <form method="POST" action="/login">
                @csrf

                <div class="form-group">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
                        class="{{ $errors->has('email') ? 'input-error' : '' }}" required autofocus>
                    @error('email')
                        <p class="error-msg">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" name="password" placeholder="Password"
                        class="{{ $errors->has('password') ? 'input-error' : '' }}" required>
                    @error('password')
                        <p class="error-msg">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn-login">Masuk dengan Email</button>
            </form>

            <p class="register-link">
                Belum memiliki akun? <a href="{{ route('register') }}">Daftar sekarang</a>
            </p>

            <p class="terms-text">
                Dengan melanjutkan, Anda menyetujui <a href="#">Ketentuan Layanan</a> dan <a href="#">Kebijakan
                    Privasi</a> kami.
            </p>
        </div>
    </div>

</body>

</html>