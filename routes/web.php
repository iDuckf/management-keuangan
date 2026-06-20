<?php

use App\Http\Controllers\AuthContoller;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthContoller::class, 'index'])->name('login');
Route::get('/signup', [AuthContoller::class, 'showSignup'])->name('signup');
Route::post('/login', [AuthContoller::class, 'login'])->name('login.submit');
Route::post('/signup', [AuthContoller::class, 'signup'])->name('signup.submit');

//Route untuk verifikasi Email
Route::get('/email/verify', [AuthContoller::class, 'emailVerify'])->middleware('auth')->name('verification.notice');

//Route ketika user klik verifikasi di email
Route::get('/email/verify/{id}/{hash}', [AuthContoller::class, 'verified'])->middleware('auth', 'signed', 'throttle: 6,1')->name('verification.verify');

//Route untuk kirim ulang email verifikasi
Route::post('/email/verification-notification', [AuthContoller::class, 'resendEmailVerify'])->middleware('auth', 'throttle:6,1')->name('verification.resend');
