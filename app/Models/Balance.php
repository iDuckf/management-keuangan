<?php

namespace App\Models;

use Database\Factories\BalanceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Balance extends Model
{
    /** @use HasFactory<BalanceFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'tipe', 'amount'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function incomes(): HasMany
    {
        return $this->hasMany(Income::class, 'balance_id');
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class, 'balance_id');
    }
}
