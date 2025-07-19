<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;
use App\Models\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Default categories for new users
        $defaultCategories = [
            // Income categories
            ['name' => 'Salary', 'type' => 'income', 'color' => '#10B981', 'icon' => 'fas fa-money-bill-wave'],
            ['name' => 'Freelance', 'type' => 'income', 'color' => '#10B981', 'icon' => 'fas fa-laptop'],
            ['name' => 'Investment', 'type' => 'income', 'color' => '#10B981', 'icon' => 'fas fa-chart-line'],
            ['name' => 'Other Income', 'type' => 'income', 'color' => '#10B981', 'icon' => 'fas fa-plus-circle'],

            // Expense categories
            ['name' => 'Food & Dining', 'type' => 'expense', 'color' => '#EF4444', 'icon' => 'fas fa-utensils'],
            ['name' => 'Transportation', 'type' => 'expense', 'color' => '#F59E0B', 'icon' => 'fas fa-car'],
            ['name' => 'Shopping', 'type' => 'expense', 'color' => '#8B5CF6', 'icon' => 'fas fa-shopping-bag'],
            ['name' => 'Entertainment', 'type' => 'expense', 'color' => '#EC4899', 'icon' => 'fas fa-gamepad'],
            ['name' => 'Healthcare', 'type' => 'expense', 'color' => '#06B6D4', 'icon' => 'fas fa-heartbeat'],
            ['name' => 'Education', 'type' => 'expense', 'color' => '#84CC16', 'icon' => 'fas fa-graduation-cap'],
            ['name' => 'Housing', 'type' => 'expense', 'color' => '#F97316', 'icon' => 'fas fa-home'],
            ['name' => 'Utilities', 'type' => 'expense', 'color' => '#6366F1', 'icon' => 'fas fa-bolt'],
            ['name' => 'Insurance', 'type' => 'expense', 'color' => '#14B8A6', 'icon' => 'fas fa-shield-alt'],
            ['name' => 'Other Expenses', 'type' => 'expense', 'color' => '#6B7280', 'icon' => 'fas fa-ellipsis-h'],
        ];

        // Default accounts for new users
        $defaultAccounts = [
            ['name' => 'Cash', 'type' => 'cash', 'balance' => 0.00, 'currency' => 'USD'],
            ['name' => 'Bank Account', 'type' => 'bank', 'balance' => 0.00, 'currency' => 'USD'],
            ['name' => 'Credit Card', 'type' => 'credit', 'balance' => 0.00, 'currency' => 'USD'],
        ];

    }
}
