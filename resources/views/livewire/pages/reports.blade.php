<div class="reports-container">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Reports & Analytics</h4>
            <p class="text-muted mb-0">Financial insights and trends</p>
        </div>
        <div class="btn-group">
            <button class="btn btn-outline-primary" onclick="window.print()">
                <i class="fas fa-print me-2"></i>Print Report
            </button>
            <button class="btn btn-outline-success">
                <i class="fas fa-download me-2"></i>Export
            </button>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Time Period</label>
                    <select class="form-select" wire:model.live="selectedPeriod">
                        <option value="current_month">Current Month</option>
                        <option value="last_month">Last Month</option>
                        <option value="current_year">Current Year</option>
                        <option value="last_30_days">Last 30 Days</option>
                        <option value="last_90_days">Last 90 Days</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Category</label>
                    <select class="form-select" wire:model.live="selectedCategory">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Account</label>
                    <select class="form-select" wire:model.live="selectedAccount">
                        <option value="">All Accounts</option>
                        @foreach($accounts as $account)
                            <option value="{{ $account->id }}">{{ $account->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">&nbsp;</label>
                    <button class="btn btn-outline-secondary w-100" wire:click="loadData">
                        <i class="fas fa-refresh me-2"></i>Refresh
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Total Income</h6>
                            <h4 class="mb-0">${{ number_format($reportData['total_income'] ?? 0, 2) }}</h4>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-arrow-up fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Total Expenses</h6>
                            <h4 class="mb-0">${{ number_format($reportData['total_expenses'] ?? 0, 2) }}</h4>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-arrow-down fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-{{ ($reportData['net_amount'] ?? 0) >= 0 ? 'primary' : 'warning' }} text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Net Amount</h6>
                            <h4 class="mb-0">${{ number_format($reportData['net_amount'] ?? 0, 2) }}</h4>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-chart-line fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Transactions</h6>
                            <h4 class="mb-0">{{ $reportData['transaction_count'] ?? 0 }}</h4>
                            <small>Avg: ${{ number_format($reportData['avg_transaction'] ?? 0, 2) }}</small>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-exchange-alt fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Expense by Category</h6>
                </div>
                <div class="card-body">
                    @if(count($chartData['category_breakdown'] ?? []) > 0)
                        <div class="category-breakdown">
                            @foreach($chartData['category_breakdown'] as $category)
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="category-color me-3" style="width: 20px; height: 20px; background-color: {{ $category['color'] }}; border-radius: 50%;"></div>
                                        <div>
                                            <strong>{{ $category['name'] }}</strong>
                                            <div class="text-muted small">{{ $category['icon'] }}</div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <strong>${{ number_format($category['amount'], 2) }}</strong>
                                        <div class="text-muted small">
                                            {{ $reportData['total_expenses'] > 0 ? number_format(($category['amount'] / $reportData['total_expenses']) * 100, 1) : 0 }}%
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-chart-pie fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No expense data available for the selected period.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Monthly Trend</h6>
                </div>
                <div class="card-body">
                    @if(count($chartData['monthly_trend'] ?? []) > 0)
                        <div class="monthly-trend">
                            @foreach($chartData['monthly_trend'] as $index => $month)
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <strong>Month {{ $index + 1 }}</strong>
                                    </div>
                                    <div class="text-end">
                                        <div class="text-success">Income: ${{ number_format($month['income'], 2) }}</div>
                                        <div class="text-danger">Expenses: ${{ number_format($month['expenses'], 2) }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-chart-line fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No trend data available for the selected period.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="card">
        <div class="card-header">
            <h6 class="mb-0">Recent Transactions</h6>
        </div>
        <div class="card-body">
            @php
                $recentTransactions = \App\Models\Transaction::where('user_id', auth()->id())
                    ->with(['category', 'account'])
                    ->orderBy('date', 'desc')
                    ->take(5)
                    ->get();
            @endphp
            
            @if($recentTransactions->count() > 0)
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Amount</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentTransactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->date->format('M d') }}</td>
                                    <td>{{ $transaction->description }}</td>
                                    <td>
                                        @if($transaction->category)
                                            <span class="badge" style="background-color: {{ $transaction->category->color }}; color: #fff;">
                                                {{ $transaction->category->name }}
                                            </span>
                                        @else
                                            <span class="text-muted">No category</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="fw-bold {{ $transaction->type === 'income' ? 'text-success' : 'text-danger' }}">
                                            {{ $transaction->type === 'income' ? '+' : '-' }}${{ number_format($transaction->amount, 2) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $transaction->type === 'income' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($transaction->type) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No recent transactions found.</p>
                </div>
            @endif
        </div>
    </div>
    <style>
        .reports-container {
            padding: 1.5rem;
        }
        .category-color {
            min-width: 20px;
        }
        @media print {
            .btn-group, .card-header button {
                display: none !important;
            }
        }
    </style>
    
</div>

