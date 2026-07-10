<?php

namespace Database\Factories;

use App\Models\Balance;
use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends Factory<Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category_id = [1, 2, 3, 4, 5, 6, 7, 8, 9];
        $user_id = [1, 2, 3, 4, 5, 6, 7, 8, 9];
        $titles = ['Makan Malam Di GGG', 'Isi Bensin', 'Netflix'];
        $amounts = [1000000, 540032, 57039284, 216927498];

        return [
            'category_id' => Arr::random($category_id),
            'user_id' => Arr::random($user_id),
            'balance_id' => Balance::factory(),
            'title' => Arr::random($titles),
            'amount' => Arr::random($amounts),
            'date' => now(),
            'description' => fake()->text(200)
        ];
    }
}
