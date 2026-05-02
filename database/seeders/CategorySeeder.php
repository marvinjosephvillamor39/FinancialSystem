<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $incomeCategories = [
            'Salary',
            'Freelance',
            'Investment',
            'Gift',
            'Other',
        ];

        $expenseCategories = [
            'Food',
            'Rent',
            'Utilities',
            'Transportation',
            'Entertainment',
            'Health',
            'Other',
        ];

        foreach ($incomeCategories as $name) {
            Category::firstOrCreate([
                'name' => $name,
                'type' => 'income',
            ]);
        }

        foreach ($expenseCategories as $name) {
            Category::firstOrCreate([
                'name' => $name,
                'type' => 'expense',
            ]);
        }
    }
}
