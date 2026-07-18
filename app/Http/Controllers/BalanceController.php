<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BalanceController extends Controller
{
    public function balanceSave(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'tipe' => 'required|string|max:100',
            'amount' => 'required|numeric',
        ]);

        Balance::create([
            'user_id' => session('id'),
            'name' => $request->name,
            'tipe' => Str::lower($request->tipe),
            'amount' => $request->amount,
        ]);

        return redirect()->route('balances-show')->with('success', 'Balance baru berhasil ditambahkan!');
    }

    public function balanceEdit(Request $request, Balance $balance)
    {
        $request->validate([
            'edit_name' => 'required|string|max:100',
            'edit_tipe' => 'required|string|max:100',
            'edit_amount' => 'required|numeric',
        ]);

        $balance->update([
            'name' => $request->edit_name,
            'tipe' => Str::lower($request->edit_tipe),
            'amount' => $request->edit_amount,
        ]);

        return redirect()->route('balances-show')->with('success', 'Balance berhasil diperbarui!');
    }

    public function balanceDelete(Balance $balance)
    {
        $balance->delete();

        return redirect()->route('balances-show')->with('success', 'Balance berhasil dihapus!');
    }
}
