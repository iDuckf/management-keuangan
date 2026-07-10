<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('dashboard', [
            'title' => 'Dashboard',
        ]);
    }

    // INCOMES
    public function incomesShow()
    {
        $user = User::where('email', session('email'))->first();

        $incomes = $user->incomes;
        $categories = $user->categories;
        $balances = $user->balances;
        $incomesThisMonth = $user->incomes()->whereMonth('date', Carbon::now()->month)->whereYear('date', Carbon::now()->year)->get();
        $totalIncomes = $incomes->sum('amount');
        $totalIncomesThisMonth = $incomesThisMonth->sum('amount');
        $jumlahRowIncomes = $incomes->count();

        return view('incomes', [
            'title' => 'Incomes',
            'totalIncomes' => $totalIncomes,
            'totalThisMonth' => $totalIncomesThisMonth,
            'totalEntries' => $jumlahRowIncomes,
            'incomes' => $user->incomes()->paginate(10),
            'categories' => $categories,
            'balances' => $balances
        ]);
    }

    // CATEGORIES
    public function categoryShow()
    {
        $user = User::where('email', session('email'))->first();

        $groupedCategories = $user->categories()->get()->groupBy('type');

        return view('categories', [
            'title' => 'Categories',
            'groupedCategories' => $groupedCategories
        ]);
    }

    // EXPENSES
    public function expensesShow()
    {
        $user = User::where('email', session('email'))->first();

        $expenses = $user->expenses;
        $categories = $user->categories;
        $balances = $user->balances;
        $expensesThisMonth = $user->expenses()->whereMonth('date', Carbon::now()->month)->whereYear('date', Carbon::now()->year)->get();
        $totalExpenses = $expenses->sum('amount');
        $totalExpensesThisMonth = $expensesThisMonth->sum('amount');
        $jumlahRowExpenses = $expenses->count();

        return view('expenses', [
            'title' => 'Expenses',
            'totalExpenses' => $totalExpenses,
            'totalThisMonth' => $totalExpensesThisMonth,
            'totalEntries' => $jumlahRowExpenses,
            'expenses' => $user->expenses()->paginate(10),
            'categories' => $categories,
            'balances' => $balances
        ]);
    }

    // BALANCES
    public function balancesShow()
    {
        $user = User::where('email', session('email'))->first();

        $balances = $user->balances;
        $totalBalance = $balances->sum('amount');

        return view('balances', [
            'title' => 'Balances',
            'totalBalance' => $totalBalance,
            'balances' => $balances
        ]);
    }
}
