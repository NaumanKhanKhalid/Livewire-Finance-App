<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SettingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Demo route
Route::get('/demo', function () {
    return view('demo');
})->name('demo');

// Authentication routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// SPA Application Route (Livewire)
Route::get('/app', function () {
    return view('app');
})->name('app')->middleware('auth');

// Protected routes (redirect to SPA)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('app');
    })->name('dashboard');
    
    Route::get('/transactions', function () {
        return redirect()->route('app');
    })->name('transactions');
    
    Route::get('/budgets', function () {
        return redirect()->route('app');
    })->name('budgets');
    
    Route::get('/reports', function () {
        return redirect()->route('app');
    })->name('reports');
    
    Route::get('/accounts', function () {
        return redirect()->route('app');
    })->name('accounts');
    
    Route::get('/categories', function () {
        return redirect()->route('app');
    })->name('categories');
    
    Route::get('/settings', function () {
        return redirect()->route('app');
    })->name('settings');
});

// API routes for AJAX requests
Route::middleware('auth')->prefix('api')->group(function () {
    Route::get('/transactions', function () {
        return App\Models\Transaction::where('user_id', auth()->id())->get();
    });
    
    Route::get('/categories', function () {
        return App\Models\Category::where('user_id', auth()->id())->get();
    });
    
    Route::get('/accounts', function () {
        return App\Models\Account::where('user_id', auth()->id())->get();
    });
});

// Redirect root to demo
Route::get('/', function () {
    return redirect()->route('demo');
});