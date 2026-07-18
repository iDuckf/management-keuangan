<?php

namespace Database\Factories;

use App\Models\Balance;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends Factory<Balance>
 */
class BalanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['cash', 'ewallet', 'bank'];

        return [
            'user_id' => User::factory(),
            'name' => fake()->name(),
            'tipe' => Arr::random($types),
            'amount' => fake()->numberBetween(1000000, 3000000),
        ];
    }
}
