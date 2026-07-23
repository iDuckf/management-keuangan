<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = User::where('email', session('email'))->first();
        $year = $request->input('year', Carbon::now()->year);

        $allIncomes = $user->incomes()->get();
        $allExpenses = $user->expenses()->get();

        $years = $allIncomes->pluck('date')->merge($allExpenses->pluck('date'))
            ->map(fn ($d) => Carbon::parse($d)->year)
            ->unique()->sortDesc()->values();

        $incomesThisMonth = $user->incomes()->whereMonth('date', Carbon::now()->month)->whereYear('date', $request->year ?? $year)->get();
        $expensesThisMonth = $user->expenses()->whereMonth('date', Carbon::now()->month)->whereYear('date', $request->year ?? $year)->get();
        $totalBalances = $user->balances->sum('amount');

        $monthlyIncomesChart = $user->incomes()->whereYear('date', $request->year ?? $year)->get()->groupBy(fn ($i) => $i->date->month)->map(fn ($g) => $g->sum('amount'));

        $monthlyExpensesChart = $user->expenses()->whereYear('date', $request->year ?? $year)->get()->groupBy(fn ($e) => $e->date->month)->map(fn ($g) => $g->sum('amount'));

        $incomeDataChart = [];
        $expenseDataChart = [];

        for ($m = 1; $m <= 12; $m++) {
            $incomeDataChart[] = $monthlyIncomesChart->get($m, 0);
            $expenseDataChart[] = $monthlyExpensesChart->get($m, 0);
        }

        $expensesByCategory = $user->expenses()->with('category')->whereYear('date', $request->year ?? $year)->get()->groupBy(fn ($e) => $e->category?->name ?? 'Lainnya')->map(fn ($g) => [
            'total' => $g->sum('amount'),
            'color' => $g->first()->category?->color ?? '#6b7280',
        ]);

        $donutLabels = $expensesByCategory->keys()->values();
        $donutDatas = $expensesByCategory->pluck('total')->values();
        $donutColors = $expensesByCategory->pluck('color')->values();

        $groupedBalances = $user->balances()->get()->groupBy(fn ($b) => $b->tipe ?? 'Kosong')->map(fn ($g) => [
            'total' => $g->sum('amount'),
        ]);

        return view('dashboard', [
            'title' => 'Dashboard',
            'totalIncomesMonth' => $incomesThisMonth->sum('amount'),
            'totalIncomesEntries' => $incomesThisMonth->count(),
            'totalExpensesMonth' => $expensesThisMonth->sum('amount'),
            'totalExpensesEntries' => $expensesThisMonth->count(),
            'totalBalances' => $totalBalances,
            'selectedYear' => (int) $year,
            'incomeDataChart' => $incomeDataChart,
            'expenseDataChart' => $expenseDataChart,
            'donutLabels' => $donutLabels,
            'donutDatas' => $donutDatas,
            'donutColors' => $donutColors,
            'groupedBalances' => $groupedBalances,
            'newestIncomes' => $user->incomes()->with('category', 'balance')->orderByDesc('date')->latest()->take(5)->get(),
            'newestExpenses' => $user->expenses()->with('category', 'balance')->orderByDesc('date')->latest()->take(5)->get(),
            'years' => $years,
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
            'incomes' => $user->incomes()->with('category', 'balance')->paginate(10),
            'categories' => $categories,
            'balances' => $balances,
        ]);
    }

    // CATEGORIES
    public function categoryShow()
    {
        $user = User::where('email', session('email'))->first();

        $groupedCategories = $user->categories()->get()->groupBy('type');

        return view('categories', [
            'title' => 'Categories',
            'groupedCategories' => $groupedCategories,
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
            'expenses' => $user->expenses()->with('category', 'balance')->paginate(10),
            'categories' => $categories,
            'balances' => $balances,
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
            'balances' => $balances,
        ]);
    }
}
