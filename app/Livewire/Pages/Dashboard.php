<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Transaction;
use App\Models\Budget;
use App\Models\Account;
use Carbon\Carbon;

class Dashboard extends Component
{
    public $monthlyIncome = 0;
    public $monthlyExpenses = 0;
    public $monthlyBalance = 0;
    public $budgetProgress = 0;
    public $recentTransactions = [];
    public $categoryData = [];
    public $accountBalances = [];

    public function mount()
    {
        $this->loadDashboardData();
    }

    public function loadDashboardData()
    {
        $currentMonth = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();
        $userId = auth()->id();

        // Calculate monthly income and expenses
        $this->monthlyIncome = Transaction::where('user_id', $userId)
            ->where('type', 'income')
            ->whereMonth('date', $currentMonth->month)
            ->whereYear('date', $currentMonth->year)
            ->sum('amount');

        $this->monthlyExpenses = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->whereMonth('date', $currentMonth->month)
            ->whereYear('date', $currentMonth->year)
            ->sum('amount');

        $this->monthlyBalance = $this->monthlyIncome - $this->monthlyExpenses;

        // Load recent transactions
        $this->recentTransactions = Transaction::where('user_id', $userId)
            ->with(['category', 'account'])
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get();

        // Load category data for charts
        $this->categoryData = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->whereMonth('date', $currentMonth->month)
            ->whereYear('date', $currentMonth->year)
            ->with('category')
            ->get()
            ->groupBy('category.name')
            ->map(function ($transactions) {
                return $transactions->sum('amount');
            })
            ->toArray();    

        // Load account balances
        $this->accountBalances = Account::where('user_id', $userId)
            ->withSum([
                'transactions as total_income' => function ($query) {
                    $query->where('type', 'income');
                }
            ], 'amount')
            ->withSum([
                'transactions as total_expenses' => function ($query) {
                    $query->where('type', 'expense');
                }
            ], 'amount')
            ->get()
            ->map(function ($account) {
                return [
                    'name' => $account->name,
                    'balance' => ($account->total_income ?? 0) - ($account->total_expenses ?? 0),
                    'type' => $account->type
                ];
            })
            ->toArray();

        // Calculate budget progress - using date range instead of month column
        $totalBudget = Budget::where('user_id', $userId)
            ->where('period', 'monthly')
            ->where(function ($query) use ($currentMonth, $currentMonthEnd) {
                $query->where(function ($q) use ($currentMonth, $currentMonthEnd) {
                    // Budgets that overlap with current month
                    $q->where('start_date', '<=', $currentMonthEnd)
                        ->where('end_date', '>=', $currentMonth);
                });
            })
            ->sum('amount');

        if ($totalBudget > 0) {
            $this->budgetProgress = min(100, ($this->monthlyExpenses / $totalBudget) * 100);
        }
    }

    public function refreshData()
    {
        $this->loadDashboardData();
    }

    public function render()
    {
        return view('livewire.pages.dashboard');
    }
}
