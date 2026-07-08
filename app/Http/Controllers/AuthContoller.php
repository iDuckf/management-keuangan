<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthContoller extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            session([
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email
            ]);

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function showSignup()
    {
        return view('signup');
    }

    public function signup(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('verification.notice');
    }

    public function emailVerify()
    {
        return view('auth.verify-email');
    }

    public function verified(EmailVerificationRequest $request)
    {
        // Otomatis akan membuat user login
        $request->fulfill();

        // Paksa logout setelah verifikasi sukses
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Lempar ke halaman login dengan pesan sukses
        return redirect('/')->with('status', 'Email berhasil diverifikasi! Silakan login kembali.');
    }

    public function resendEmailVerify(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }

    public function forgotPassword(Request $request)
    {
        // Validasi email wajib diisi dan formatnya benar
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Email tidak terdaftar di sistem kami.',
        ]);

        // Kirimkan link reset password ke email user
        $status = Password::broker()->sendResetLink(
            $request->only('email')
        );

        // Cek status pengiriman email
        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', 'Link reset password telah dikirim ke alamat email Anda.');
        }

        return back()->withErrors(['email' => 'Gagal mengirimkan email reset password.']);
    }

    // TAMBAHKAN fungsi ini untuk menampilkan form password baru saat link di email diklik:
    public function forgotPassShow()
    {
        return view('auth.forgot-password');
    }

    public function resetPasswordShow(Request $request, $token)
    {
        // Melempar token dan email ke dalam view
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    // TAMBAHKAN fungsi ini untuk memproses password baru yang diinput user:
    public function resetPasswordSubmit(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Melakukan reset password melalui Laravel broker
        $status = Password::broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                // Logika untuk menyimpan password baru (di-hash otomatis)
                $user->password = Hash::make($password);
                $user->setRememberToken(Str::random(60));
                $user->save();

                event(new PasswordReset($user));
            }
        );

        // Jika berhasil, arahkan ke login dengan pesan sukses
        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', 'Password berhasil diubah! Silakan login.');
        }

        // Jika gagal (misal karena token kedaluwarsa)
        return back()->withErrors(['email' => __($status)]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
