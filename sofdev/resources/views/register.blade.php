<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun Baru</title>
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

        /* Mengetengahkan seluruh form secara vertikal dan horizontal di layar */
        .wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 24px;
        }

        /* Area Form utama yang pas di tengah */
        .form-area {
            max-width: 480px;
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

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .section-label {
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #71717a;
            margin: 12px 0 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-label::before,
        .section-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e4e4e7;
        }

        label {
            display: block;
            font-size: 0.85rem;
            font-weight: 500;
            color: #27272a;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"] {
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

        .btn-register {
            width: 100%;
            margin-top: 16px;
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

        .btn-register:hover {
            background: #27272a;
        }

        /* Gaya teks untuk link kembali ke halaman login */
        .login-link {
            text-align: center;
            font-size: 0.9rem;
            color: #71717a;
            margin-top: 24px;
        }

        .login-link a {
            color: #09090b;
            font-weight: 600;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }
    </style>
</head>

<body>

    <div class="wrapper">

        <div class="form-area">
            <h1>Buat akun baru</h1>
            <p class="tagline">Lengkapi data diri di bawah ini untuk mendaftar</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap" class="{{ $errors->has('name') ? 'input-error' : '' }}"
                        required autofocus>
                    @error('name')
                        <p class="error-msg">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="contoh@email.com" class="{{ $errors->has('email') ? 'input-error' : '' }}"
                            required>
                        @error('email')
                            <p class="error-msg">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="no_telepon">No. Telepon</label>
                        <input type="tel" id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}"
                            placeholder="08xxxxxxxxxx" class="{{ $errors->has('no_telepon') ? 'input-error' : '' }}"
                            required>
                        @error('no_telepon')
                            <p class="error-msg">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Minimal 8 karakter"
                            class="{{ $errors->has('password') ? 'input-error' : '' }}" required>
                        @error('password')
                            <p class="error-msg">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="Ulangi password" required>
                    </div>
                </div>

                {{-- ── BAGIAN ALAMAT ── --}}
                <p class="section-label">Informasi Alamat</p>

                <div class="form-group">
                    <label for="kota">Kota</label>
                    <input type="text" id="kota" name="kota" value="{{ old('kota') }}" placeholder="Nama kota"
                        class="{{ $errors->has('kota') ? 'input-error' : '' }}" required>
                    @error('kota')
                        <p class="error-msg">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="kecamatan">Kecamatan</label>
                        <input type="text" id="kecamatan" name="kecamatan" value="{{ old('kecamatan') }}"
                            placeholder="Nama kecamatan" class="{{ $errors->has('kecamatan') ? 'input-error' : '' }}"
                            required>
                        @error('kecamatan')
                            <p class="error-msg">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kode_pos">Kode Pos</label>
                        <input type="text" id="kode_pos" name="kode_pos" value="{{ old('kode_pos') }}"
                            placeholder="64100" maxlength="5"
                            class="{{ $errors->has('kode_pos') ? 'input-error' : '' }}" required>
                        @error('kode_pos')
                            <p class="error-msg">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn-register">Daftar Akun Baru</button>
            </form>

            <p class="login-link">
                Sudah memiliki akun? <a href="{{ route('login') }}">Masuk di sini</a>
            </p>
        </div>
    </div>

</body>

</html>