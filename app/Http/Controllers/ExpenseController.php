<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function expenseSave(Request $request)
    {
        $amountInput = $request->amount;
        $balance = Balance::findOrFail($request->balance_id)->amount;

        $request->validate([
            'title' => 'required|string|max:100',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'description' => 'string|nullable',
        ]);

        if ($amountInput <= $balance) {
            Expense::create([
                'category_id' => $request->category_id,
                'user_id' => session('id'),
                'balance_id' => $request->balance_id,
                'title' => $request->title,
                'amount' => $request->amount,
                'date' => $request->date,
                'description' => $request->description,
            ]);

            Balance::findOrFail($request->balance_id)->decrement('amount', $request->amount);
        } else {
            return redirect()->back()->withErrors([
                'amount' => 'Saldo tidak mencukupi. Saldo kamu: Rp. '.number_format($balance, 0, ',', '.'),
            ])->withInput();
        }

        return redirect()->route('expenses-show')->with('success', 'Expense baru kamu berhasil disimpan!');
    }

    public function expenseEdit(Request $request, Expense $expense)
    {
        $amountInput = $request->edit_amount;
        $balance = Balance::findOrFail($request->edit_balance_id)->amount;
        $oldBalanceId = $expense->balance_id;
        $oldAmount = $expense->amount;
        $newBalanceId = $request->edit_balance_id;
        $newAmount = $request->edit_amount;

        $request->validate([
            'edit_title' => 'required|string|max:100',
            'edit_amount' => 'required|numeric',
            'edit_date' => 'required|date',
            'edit_category_id' => 'required|exists:categories,id',
            'edit_description' => 'string|nullable',
        ]);

        if ($amountInput <= $balance) {
            $expense->update([
                'category_id' => $request->edit_category_id,
                'user_id' => session('id'),
                'balance_id' => $request->edit_balance_id,
                'title' => $request->edit_title,
                'amount' => $request->edit_amount,
                'date' => $request->edit_date,
                'description' => $request->edit_description,
            ]);

            // tambahkan amount dari balance yang lama
            Balance::findOrFail($oldBalanceId)->increment('amount', $oldAmount);

            // kurangi amount daru balance yang baru
            Balance::findOrFail($newBalanceId)->decrement('amount', $newAmount);
        }

        return redirect()->route('expenses-show')->with('success', 'Perubahan income kamu berhasil disimpan!');
    }

    public function expenseDelete(Expense $expense)
    {
        // kurangi amount dari balance
        if ($expense->balance_id) {
            $expense->balance()->increment('amount', $expense->amount);
        }

        $expense->delete();

        return redirect()->route('expenses-show')->with('success', 'Expense berhasil dihapus!');
    }
}
