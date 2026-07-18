<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_id = [1, 2, 3, 4, 5, 6, 7, 8, 9];
        $name = fake()->name();
        $types = ['income', 'expense'];
        $colors = ['#00FF00', '#FF0000'];

        return [
            'user_id' => Arr::random($user_id),
            'name' => $name,
            'slug' => Str::slug($name),
            'type' => Arr::random($types),
            'color' => Arr::random($colors),
        ];
    }
}
