<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\Account;
use Carbon\Carbon;

class Reports extends Component
{
    public $selectedPeriod = 'current_month';
    public $selectedCategory = '';
    public $selectedAccount = '';
    public $categories;
    public $accounts;
    public $reportData = [];
    public $chartData = [];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->categories = Category::where('user_id', auth()->id())->get();
        $this->accounts = Account::where('user_id', auth()->id())->get();
        $this->generateReport();
    }

    public function generateReport()
    {
        $query = Transaction::where('user_id', auth()->id());

        // Apply period filter
        switch ($this->selectedPeriod) {
            case 'current_month':
                $query->whereBetween('date', [now()->startOfMonth(), now()->endOfMonth()]);
                break;
            case 'last_month':
                $query->whereBetween('date', [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()]);
                break;
            case 'current_year':
                $query->whereBetween('date', [now()->startOfYear(), now()->endOfYear()]);
                break;
            case 'last_30_days':
                $query->whereBetween('date', [now()->subDays(30), now()]);
                break;
            case 'last_90_days':
                $query->whereBetween('date', [now()->subDays(90), now()]);
                break;
        }

        // Apply category filter
        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        // Apply account filter
        if ($this->selectedAccount) {
            $query->where('account_id', $this->selectedAccount);
        }

        $transactions = $query->with(['category', 'account'])->get();

        // Calculate summary data
        $this->reportData = [
            'total_income' => $transactions->where('type', 'income')->sum('amount'),
            'total_expenses' => $transactions->where('type', 'expense')->sum('amount'),
            'net_amount' => $transactions->where('type', 'income')->sum('amount') - $transactions->where('type', 'expense')->sum('amount'),
            'transaction_count' => $transactions->count(),
            'avg_transaction' => $transactions->count() > 0 ? $transactions->avg('amount') : 0,
        ];

        // Generate chart data
        $this->generateChartData($transactions);
    }

    public function generateChartData($transactions)
    {
        // Category breakdown for expenses
        $categoryData = $transactions->where('type', 'expense')
            ->groupBy('category_id')
            ->map(function ($group) {
                $category = $group->first()->category;
                return [
                    'name' => $category ? $category->name : 'Uncategorized',
                    'amount' => $group->sum('amount'),
                    'color' => $category ? $category->color : '#6c757d',
                    'icon' => $category ? $category->icon : 'fas fa-question',
                ];
            })
            ->sortByDesc('amount')
            ->take(10)
            ->values();

        // Monthly trend data
        $monthlyData = $transactions
            ->groupBy(function ($transaction) {
                return $transaction->date->format('Y-m');
            })
            ->map(function ($group) {
                return [
                    'income' => $group->where('type', 'income')->sum('amount'),
                    'expenses' => $group->where('type', 'expense')->sum('amount'),
                ];
            })
            ->sortKeys()
            ->values();

        // Daily spending trend
        $dailyData = $transactions->where('type', 'expense')
            ->groupBy(function ($transaction) {
                return $transaction->date->format('Y-m-d');
            })
            ->map(function ($group) {
                return $group->sum('amount');
            })
            ->sortKeys()
            ->take(30)
            ->values();

        $this->chartData = [
            'category_breakdown' => $categoryData,
            'monthly_trend' => $monthlyData,
            'daily_spending' => $dailyData,
        ];
    }

    public function updatedSelectedPeriod()
    {
        $this->generateReport();
    }

    public function updatedSelectedCategory()
    {
        $this->generateReport();
    }

    public function updatedSelectedAccount()
    {
        $this->generateReport();
    }

    public function render()
    {
        return view('livewire.pages.reports');
    }
}
