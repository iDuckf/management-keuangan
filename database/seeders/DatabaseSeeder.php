<?php

namespace Database\Seeders;

use App\Models\Balance;
use App\Models\Category;
use App\Models\Expense;
use App\Models\Income;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory(10)->create();
        Balance::factory(5)->create();
        Category::factory(10)->create();
        Income::factory(5)->create();
        Expense::factory(5)->create();
    }
}
