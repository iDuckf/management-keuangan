<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;

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
}
