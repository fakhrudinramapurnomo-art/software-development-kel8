<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // LOGIN

    // Tampilkan halaman login
    public function showLogin()
    {
        return view('login');
    }

    // Proses login
    public function login(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        // 2. Ambil kredensial dari form
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        // 3. Coba login
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate(); // cegah session fixation
            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Email atau password salah.');
        }
        // 4. Gagal login → kembali ke form dengan pesan error
        return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'Email atau password salah.',
            ]);
    }

    // ──────────────────────────────────────────
    // REGISTER
    // ──────────────────────────────────────────

    // Tampilkan halaman register
    public function showRegister()
    {
        return view('register');
    }

    // Proses register
    public function register(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'no_telepon' => 'required|digits_between:10,13',
            'kota' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kode_pos' => 'required|digits:5',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'no_telepon.required' => 'No. telepon wajib diisi.',
            'no_telepon.digits_between' => 'No. telepon harus 10–13 digit.',
            'kota.required' => 'Kota wajib diisi.',
            'kecamatan.required' => 'Kecamatan wajib diisi.',
            'kode_pos.required' => 'Kode pos wajib diisi.',
            'kode_pos.digits' => 'Kode pos harus 5 digit angka.',
        ]);

        // 2. Simpan user baru ke database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // enkripsi password
            'no_telepon' => $request->no_telepon,
            'kota' => $request->kota,
            'kecamatan' => $request->kecamatan,
            'kode_pos' => $request->kode_pos,
        ]);

        // 3. Login otomatis setelah register
        // Auth::login($user);
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan masuk.');

        // 4. Redirect ke dashboard
        return redirect('/dashboard')->with('success', 'Akun berhasil dibuat! Selamat datang.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}