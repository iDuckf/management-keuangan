<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('dashboard', [
            'title' => 'Dashboard',
        ]);
    }

    public function incomesShow()
    {
        $user = User::where('email', session('email'))->first();

        $incomes = $user->incomes;
        $categories = $user->categories;
        $incomesThisMonth = $user->incomes()->whereMonth('date', Carbon::now()->month)->whereYear('date', Carbon::now()->year)->get();
        $totalIncomes = $incomes->sum('amount');
        $totalIncomesThisMonth = $incomesThisMonth->sum('amount');
        $jumlahRowIncomes = $incomes->count();

        return view('incomes', [
            'title' => 'Incomes',
            'totalIncomes' => $totalIncomes,
            'totalThisMonth' => $totalIncomesThisMonth,
            'totalEntries' => $jumlahRowIncomes,
            'incomes' => $incomes,
            'categories' => $categories
        ]);
    }

    public function incomeSave(Request $request)
    {
        $request->validate([
            'source' => 'required|string|max:100',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'description' => 'string|nullable'
        ]);

        Income::create([
            'category_id' => $request->category_id,
            'user_id' => session('id'),
            'source' => $request->source,
            'amount' => $request->amount,
            'date' => $request->date,
            'description' => $request->description
        ]);

        return redirect()->route('incomes-show')->with('success', 'Income baru kamu berhasil disimpan!');
    }

    public function incomeEdit(Request $request, Income $income)
    {
        $request->validate([
            'source' => 'required|string|max:100',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'description' => 'string|nullable'
        ]);

        $income->update([
            'category_id' => $request->category_id,
            'user_id' => session('id'),
            'source' => $request->source,
            'amount' => $request->amount,
            'date' => $request->date,
            'description' => $request->description
        ]);

        return redirect()->route('incomes-show')->with('success', 'Perubahan income kamu berhasil disimpan!');
    }

    public function incomeDelete(Income $income)
    {
        $income->delete();
        return redirect()->route('incomes-show')->with('success', 'Income entry kamu berhasil dihapus!');
    }

    public function categoriesShow()
    {
        return view('categories', [
            'title' => 'Categories',
        ]);
    }

    public function expensesShow()
    {
        return view('expenses', [
            'title' => 'Expenses',
        ]);
    }
}
