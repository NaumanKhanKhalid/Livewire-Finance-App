<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Account;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/app');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        // Create default categories for the user
        $this->createDefaultCategories($user->id);

        // Create default accounts for the user
        $this->createDefaultAccounts($user->id);

        Auth::login($user);

        return redirect('/app');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    private function createDefaultCategories($userId)
    {
        $defaultCategories = [
            ['name' => 'Food & Dining', 'color' => '#10B981', 'icon' => 'fas fa-utensils'],
            ['name' => 'Transportation', 'color' => '#3B82F6', 'icon' => 'fas fa-car'],
            ['name' => 'Shopping', 'color' => '#8B5CF6', 'icon' => 'fas fa-shopping-bag'],
            ['name' => 'Entertainment', 'color' => '#F59E0B', 'icon' => 'fas fa-film'],
            ['name' => 'Healthcare', 'color' => '#EF4444', 'icon' => 'fas fa-heartbeat'],
            ['name' => 'Education', 'color' => '#06B6D4', 'icon' => 'fas fa-graduation-cap'],
            ['name' => 'Utilities', 'color' => '#84CC16', 'icon' => 'fas fa-bolt'],
            ['name' => 'Housing', 'color' => '#F97316', 'icon' => 'fas fa-home'],
            ['name' => 'Salary', 'color' => '#10B981', 'icon' => 'fas fa-dollar-sign'],
            ['name' => 'Freelance', 'color' => '#3B82F6', 'icon' => 'fas fa-laptop'],
            ['name' => 'Investment', 'color' => '#8B5CF6', 'icon' => 'fas fa-chart-line'],
            ['name' => 'Other', 'color' => '#6B7280', 'icon' => 'fas fa-ellipsis-h'],
        ];

        foreach ($defaultCategories as $category) {
            Category::create([
                'user_id' => $userId,
                'name' => $category['name'],
                'color' => $category['color'],
                'icon' => $category['icon'],
            ]);
        }
    }

    private function createDefaultAccounts($userId)
    {
        $defaultAccounts = [
            ['name' => 'Cash', 'type' => 'cash', 'balance' => 0],
            ['name' => 'Main Bank Account', 'type' => 'bank', 'balance' => 0],
            ['name' => 'Credit Card', 'type' => 'credit', 'balance' => 0],
        ];

        foreach ($defaultAccounts as $account) {
            Account::create([
                'user_id' => $userId,
                'name' => $account['name'],
                'type' => $account['type'],
                'balance' => $account['balance'],
            ]);
        }
    }
}
