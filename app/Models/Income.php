<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Income extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = ['category_id', 'user_id', 'balance_id', 'source', 'amount', 'date', 'description'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function balance(): BelongsTo
    {
        return $this->belongsTo(Balance::class);
    }

    protected function casts(): array
    {
        return [
            'date' => 'date', // Laravel otomatis mengubahnya menjadi objek Carbon
        ];
    }
}
