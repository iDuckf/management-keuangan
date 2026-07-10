<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Income;
use App\Models\User;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
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
            'balance_id' => $request->balance_id,
            'source' => $request->source,
            'amount' => $request->amount,
            'date' => $request->date,
            'description' => $request->description
        ]);

        $balance = Balance::findOrFail($request->balance_id);
        $balance->increment('amount', $request->amount);

        return redirect()->route('incomes-show')->with('success', 'Income baru kamu berhasil disimpan!');
    }

    public function incomeEdit(Request $request, Income $income)
    {
        $oldBalanceId = $income->balance_id;
        $oldAmount = $income->amount;
        $newBalanceId = $request->edit_balance_id;
        $newAmount = $request->edit_amount;

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
            'balance_id' => $request->edit_balance_id,
            'source' => $request->edit_source,
            'amount' => $request->edit_amount,
            'date' => $request->edit_date,
            'description' => $request->edit_description
        ]);

        //kurangi amount dari balance yang lama
        Balance::findOrFail($oldBalanceId)->decrement('amount', $oldAmount);

        //tambahkan amount daru balance yang baru
        Balance::findOrFail($newBalanceId)->increment('amount', $newAmount);

        return redirect()->route('incomes-show')->with('success', 'Perubahan income kamu berhasil disimpan!');
    }

    public function incomeDelete(Income $income)
    {
        //kurangi amount dari balance
        if ($income->balance_id) {
            $income->balance()->decrement('amount', $income->amount);
        }

        $income->delete();
        return redirect()->route('incomes-show')->with('success', 'Income entry kamu berhasil dihapus!');
    }
}
