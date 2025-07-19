<div class="dashboard-container">
    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card income">
                <div class="stats-icon">
                    <i class="fas fa-arrow-up"></i>
                </div>
                <div class="stats-content">
                    <h3 class="stats-amount">${{ number_format($monthlyIncome, 2) }}</h3>
                    <p class="stats-label">Monthly Income</p>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card expense">
                <div class="stats-icon">
                    <i class="fas fa-arrow-down"></i>
                </div>
                <div class="stats-content">
                    <h3 class="stats-amount">${{ number_format($monthlyExpenses, 2) }}</h3>
                    <p class="stats-label">Monthly Expenses</p>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card balance">
                <div class="stats-icon">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="stats-content">
                    <h3 class="stats-amount {{ $monthlyBalance >= 0 ? 'text-success' : 'text-danger' }}">
                        ${{ number_format($monthlyBalance, 2) }}
                    </h3>
                    <p class="stats-label">Monthly Balance</p>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card budget">
                <div class="stats-icon">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <div class="stats-content">
                    <h3 class="stats-amount">{{ number_format($budgetProgress, 1) }}%</h3>
                    <p class="stats-label">Budget Used</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <div class="col-lg-8 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-line me-2"></i>Monthly Overview
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="monthlyChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-pie me-2"></i>Expense Categories
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="categoryChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Transactions and Account Balances -->
    <div class="row">
        <div class="col-lg-8 mb-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-history me-2"></i>Recent Transactions
                    </h5>
                    <button class="btn btn-sm btn-outline-primary" wire:click="refreshData">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
                <div class="card-body">
                    @if(count($recentTransactions) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Account</th>
                                        <th>Amount</th>
                                        <th>Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentTransactions as $transaction)
                                        <tr>
                                            <td>{{ $transaction->date->format('M d, Y') }}</td>
                                            <td>{{ $transaction->description }}</td>
                                            <td>
                                                <span class="badge" style="background-color: {{ $transaction->category->color ?? '#6c757d' }}">
                                                    {{ $transaction->category->name ?? 'Uncategorized' }}
                                                </span>
                                            </td>
                                            <td>{{ $transaction->account->name ?? 'Unknown' }}</td>
                                            <td class="{{ $transaction->type === 'income' ? 'text-success' : 'text-danger' }}">
                                                ${{ number_format($transaction->amount, 2) }}
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
                            <p class="text-muted">No transactions yet. Start by adding your first transaction!</p>
                            <button class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Add Transaction
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-credit-card me-2"></i>Account Balances
                    </h5>
                </div>
                <div class="card-body">
                    @if(count($accountBalances) > 0)
                        @foreach($accountBalances as $account)
                            <div class="account-item d-flex justify-content-between align-items-center mb-3">
<div>
                                    <h6 class="mb-0">{{ $account['name'] }}</h6>
                                    <small class="text-muted">{{ ucfirst($account['type']) }}</small>
                                </div>
                                <div class="text-end">
                                    <h6 class="mb-0 {{ $account['balance'] >= 0 ? 'text-success' : 'text-danger' }}">
                                        ${{ number_format($account['balance'], 2) }}
                                    </h6>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-credit-card fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No accounts yet. Add your first account!</p>
                            <button class="btn btn-primary btn-sm">
                                <i class="fas fa-plus me-2"></i>Add Account
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        .dashboard-container {
            padding: 1.5rem;
        }

        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: transform 0.2s ease;
        }

        .stats-card:hover {
            transform: translateY(-2px);
        }

        .stats-card.income {
            border-left: 4px solid var(--success-color);
        }

        .stats-card.expense {
            border-left: 4px solid var(--danger-color);
        }

        .stats-card.balance {
            border-left: 4px solid var(--primary-color);
        }

        .stats-card.budget {
            border-left: 4px solid var(--warning-color);
        }

        .stats-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .stats-card.income .stats-icon {
            background: linear-gradient(135deg, var(--success-color), #059669);
        }

        .stats-card.expense .stats-icon {
            background: linear-gradient(135deg, var(--danger-color), #DC2626);
        }

        .stats-card.balance .stats-icon {
            background: linear-gradient(135deg, var(--primary-color), #2563EB);
        }

        .stats-card.budget .stats-icon {
            background: linear-gradient(135deg, var(--warning-color), #D97706);
        }

        .stats-content {
            flex: 1;
        }

        .stats-amount {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            color: var(--text-color);
        }

        .stats-label {
            margin: 0;
            color: #6b7280;
            font-size: 0.875rem;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 1rem 1.5rem;
            border-radius: 15px 15px 0 0;
        }

        .card-title {
            font-weight: 600;
            color: var(--text-color);
        }

        .account-item {
            padding: 0.75rem;
            border-radius: 8px;
            background: #f9fafb;
            transition: background-color 0.2s ease;
        }

        .account-item:hover {
            background: #f3f4f6;
        }

        .table {
            margin: 0;
        }

        .table th {
            border-top: none;
            font-weight: 600;
            color: #6b7280;
            font-size: 0.875rem;
        }

        .table td {
            vertical-align: middle;
            border-top: 1px solid #f3f4f6;
        }
    </style>

    <script>
        document.addEventListener('livewire:init', () => {
            // Monthly Chart
            const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
            const monthlyChart = new Chart(monthlyCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Income',
                        data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, {{ $monthlyIncome }}],
                        borderColor: '#10B981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        tension: 0.4
                    }, {
                        label: 'Expenses',
                        data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, {{ $monthlyExpenses }}],
                        borderColor: '#EF4444',
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '$' + value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });

            // Category Chart
            const categoryCtx = document.getElementById('categoryChart').getContext('2d');
            const categoryChart = new Chart(categoryCtx, {
                type: 'doughnut',
                data: {
                    labels: @json(array_keys($categoryData)),
                    datasets: [{
                        data: @json(array_values($categoryData)),
                        backgroundColor: [
                            '#3B82F6',
                            '#10B981',
                            '#F59E0B',
                            '#EF4444',
                            '#8B5CF6',
                            '#06B6D4',
                            '#84CC16',
                            '#F97316'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        }
                    }
                }
            });

            // Update charts when data changes
            Livewire.on('data-updated', () => {
                // Refresh the page to update charts
                window.location.reload();
            });
        });
    </script>
</div>
