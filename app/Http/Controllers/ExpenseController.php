<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
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
