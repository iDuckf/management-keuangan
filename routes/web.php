<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthContoller;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthContoller::class, 'index'])->name('login');
Route::get('/signup', [AuthContoller::class, 'showSignup'])->name('signup');
Route::post('/login', [AuthContoller::class, 'login'])->name('login.submit');
Route::post('/signup', [AuthContoller::class, 'signup'])->name('signup.submit');

// Route lama kamu ...
Route::get('/forgot-password', [AuthContoller::class, 'forgotPassShow'])->name('forgot-password');
Route::post('/forgot/submit', [AuthContoller::class, 'forgotPassword'])->name('forgot-password.submit');

// TAMBAHKAN DUA ROUTE INI:
// 1. Menampilkan form input password baru (Wajib dinamai 'password.reset' agar otomatis dibaca Laravel)
Route::get('/reset-password/{token}', [AuthContoller::class, 'resetPasswordShow'])->name('password.reset');
// 2. Memproses perubahan password baru ke database
Route::post('/reset-password', [AuthContoller::class, 'resetPasswordSubmit'])->name('password.update');

// Route untuk verifikasi Email
Route::get('/email/verify', [AuthContoller::class, 'emailVerify'])->middleware('auth')->name('verification.notice');

// Route ketika user klik verifikasi di email
Route::get('/email/verify/{id}/{hash}', [AuthContoller::class, 'verified'])->middleware('auth', 'signed', 'throttle: 6,1')->name('verification.verify');

// Route untuk kirim ulang email verifikasi
Route::post('/email/verification-notification', [AuthContoller::class, 'resendEmailVerify'])->middleware('auth', 'throttle:6,1')->name('verification.resend');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthContoller::class, 'logout'])->name('logout');
    Route::get('/incomes', [AdminController::class, 'incomesShow'])->name('incomes-show');
    Route::get('/categories', [AdminController::class, 'categoryShow'])->name('categories-show');
    Route::get('/expenses', [AdminController::class, 'expensesShow'])->name('expenses-show');
    Route::get('/balances', [AdminController::class, 'balancesShow'])->name('balances-show');

    // Incomes Routes
    Route::post('/incomes', [IncomeController::class, 'incomeSave'])->name('incomes-save');
    Route::put('/incomes/{income:id}', [IncomeController::class, 'incomeEdit'])->name('income-edit');
    Route::delete('/incomes/{income:id}', [IncomeController::class, 'incomeDelete'])->name('income-delete');

    // Expenses Routes
    Route::post('/expenses', [ExpenseController::class, 'expenseSave'])->name('expense-save');
    Route::put('/expenses/{expense:id}', [ExpenseController::class, 'expenseEdit'])->name('expense-edit');
    Route::delete('/expenses/{expense:id}', [ExpenseController::class, 'expenseDelete'])->name('expense-delete');

    // Categories Routes
    Route::post('/categories', [CategoryController::class, 'categorySave'])->name('category-save');
    Route::put('/categories/{category:id}', [CategoryController::class, 'categoryEdit'])->name('category-edit');
    Route::delete('/categories/{category:id}', [CategoryController::class, 'categoryDelete'])->name('category-delete');

    // Balances Routes
    Route::post('/balances', [BalanceController::class, 'balanceSave'])->name('balances-save');
    Route::put('/balances/{balance:id}', [BalanceController::class, 'balanceEdit'])->name('balances-edit');
    Route::delete('/balances/{balance:id}', [BalanceController::class, 'balanceDelete'])->name('balances-delete');
});
