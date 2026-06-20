<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthContoller extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        //
    }

    public function showSignup()
    {
        return view('signup');
    }

    public function signup(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
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
}
