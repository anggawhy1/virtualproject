<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{

      public function showRegisterForm()
    {
        return view('partials.register');
    }
    // Register biasa (email & phone)
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15|unique:users', // wajib untuk registrasi biasa
            'password' => 'required|string|min:8|confirmed',
            'role' => 'nullable|string',
        ]);

        $role = $request->role ?? 'user';

        // Buat pengguna baru
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone, // phone hanya diperlukan saat register biasa
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

       // Memberikan response jika registrasi berhasil
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function showLoginForm()
{
    return view('partials.login-form');
}


    // Login biasa (menggunakan email atau nomor HP)
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $field = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        if (Auth::attempt([$field => $request->username, 'password' => $request->password])) {
            // Regenerasi session untuk keamanan
            $request->session()->regenerate();

            return redirect()->intended('/beranda');  
        }

        return back()->withErrors([
            'username' => 'Email atau Nomor Telepon dan Kata Sandi tidak valid',
        ]);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }


  
 // Redirect ke Google untuk autentikasi
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle callback dari Google
  public function handleGoogleCallback()
{
    try {
        // Log untuk menandai bahwa callback telah dijangkau
        \Log::info('Callback reached');

        // Mendapatkan data pengguna dari Google
        $googleUser  = Socialite::driver('google')->stateless()->user();

        if (!$googleUser  || !$googleUser ->email) {
            return redirect('/')->with('error', 'Gagal mendapatkan data pengguna dari Google.');
        }

        // Cek apakah pengguna sudah terdaftar berdasarkan email
        $user = User::where('email', $googleUser ->email)->first();

        if (!$user) {
            // Jika pengguna belum terdaftar, buat pengguna baru
            $user = User::create([
                'username' => $googleUser ->name,
                'email' => $googleUser ->email,
                'phone' => null,
                'password' => bcrypt(Str::random(16)), // Password acak untuk pengguna baru
                'role' => 'user',
            ]);
        }

        Auth::login($user, true);

        return redirect()->intended('/beranda');  
    } catch (Exception $e) {
        \Log::error('Google Login Error: ' . $e->getMessage());
        return redirect('/')->with('error', 'Gagal login menggunakan Google.');
    }
}
}