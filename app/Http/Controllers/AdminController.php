<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use App\Models\Income;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            'incomes' => $user->incomes()->paginate(10),
            'categories' => $categories
        ]);
    }

    // INCOMES
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
            'edit_source' => 'required|string|max:100',
            'edit_amount' => 'required|numeric',
            'edit_date' => 'required|date',
            'edit_category_id' => 'required|exists:categories,id',
            'edit_description' => 'string|nullable'
        ]);

        $income->update([
            'category_id' => $request->edit_category_id,
            'user_id' => session('id'),
            'source' => $request->edit_source,
            'amount' => $request->edit_amount,
            'date' => $request->edit_date,
            'description' => $request->edit_description
        ]);

        return redirect()->route('incomes-show')->with('success', 'Perubahan income kamu berhasil disimpan!');
    }

    public function incomeDelete(Income $income)
    {
        $income->delete();
        return redirect()->route('incomes-show')->with('success', 'Income entry kamu berhasil dihapus!');
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

    public function categorySave(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|string|max:100',
            'color_hex' => 'required|string'
        ]);

        Category::create([
            'user_id' => session('id'),
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'type' => Str::lower($request->type),
            'color' => $request->color_hex
        ]);

        return redirect()->route('categories-show')->with('success', 'Category baru berhasil ditambahkan!');
    }

    public function categoryEdit(Request $request, Category $category)
    {
        $request->validate([
            'edit_name' => 'required|string|max:100',
            'edit_type' => 'required|string|max:100',
            'edit_color_hex' => 'required|string'
        ]);

        $category->update([
            'name' => $request->edit_name,
            'slug' => Str::slug($request->edit_name),
            'type' => Str::lower($request->edit_type),
            'color' => $request->edit_color_hex
        ]);

        return redirect()->route('categories-show')->with('success', 'Category berhasil diperbarui!');
    }

    public function categoryDelete(Category $category)
    {
        $category->delete();
        return redirect()->route('categories-show')->with('success', 'Category berhasil dihapus!');
    }

    // EXPENSES
    public function expensesShow()
    {
        $user = User::where('email', session('email'))->first();

        $expenses = $user->expenses;
        $categories = $user->categories;
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
            'categories' => $categories
        ]);
    }

    public function expenseSave(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'description' => 'string|nullable'
        ]);

        Expense::create([
            'category_id' => $request->category_id,
            'user_id' => session('id'),
            'title' => $request->title,
            'amount' => $request->amount,
            'date' => $request->date,
            'description' => $request->description
        ]);

        return redirect()->route('expenses-show')->with('success', 'Expense baru kamu berhasil disimpan!');
    }

    public function expenseEdit(Request $request, Expense $expense)
    {
        $request->validate([
            'edit_title' => 'required|string|max:100',
            'edit_amount' => 'required|numeric',
            'edit_date' => 'required|date',
            'edit_category_id' => 'required|exists:categories,id',
            'edit_description' => 'string|nullable'
        ]);

        $expense->update([
            'category_id' => $request->edit_category_id,
            'user_id' => session('id'),
            'title' => $request->edit_title,
            'amount' => $request->edit_amount,
            'date' => $request->edit_date,
            'description' => $request->edit_description
        ]);

        return redirect()->route('expenses-show')->with('success', 'Perubahan income kamu berhasil disimpan!');
    }

    public function expenseDelete(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses-show')->with('success', 'Expense berhasil dihapus!');
    }
}
