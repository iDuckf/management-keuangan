<?php

namespace Database\Factories;

use App\Models\Income;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends Factory<Income>
 */
class IncomeFactory extends Factory
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
        $sources = ['Kerja', 'Freelance', 'Saham IHSG'];
        $amounts = [1000000, 540032, 57039284, 216927498];

        return [
            'category_id' => Arr::random($category_id),
            'user_id' => Arr::random($user_id),
            'source' => Arr::random($sources),
            'amount' => Arr::random($amounts),
            'date' => now(),
            'description' => fake()->text(200)
        ];
    }
}
