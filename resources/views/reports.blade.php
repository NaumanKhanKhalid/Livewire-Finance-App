@extends('layouts.app')

@section('title', 'Reports')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Reports & Analytics</h1>
            <div class="btn-group">
                <button class="btn btn-outline-primary">
                    <i class="fas fa-download me-2"></i>Export PDF
                </button>
                <button class="btn btn-outline-primary">
                    <i class="fas fa-file-excel me-2"></i>Export Excel
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Report Filters -->
<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 mb-3">
                <label class="form-label">Period</label>
                <select class="form-select">
                    <option value="current_month">Current Month</option>
                    <option value="last_month">Last Month</option>
                    <option value="last_3_months">Last 3 Months</option>
                    <option value="last_6_months">Last 6 Months</option>
                    <option value="current_year">Current Year</option>
                    <option value="custom">Custom Range</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Start Date</label>
                <input type="date" class="form-control" value="{{ date('Y-m-01') }}">
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">End Date</label>
                <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Category</label>
                <select class="form-select">
                    <option value="">All Categories</option>
                    <option value="food">Food & Dining</option>
                    <option value="transport">Transportation</option>
                    <option value="shopping">Shopping</option>
                    <option value="entertainment">Entertainment</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary me-2">Generate Report</button>
                <button class="btn btn-outline-secondary">Reset Filters</button>
            </div>
        </div>
    </div>
</div>

<!-- Summary Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-muted mb-1">Total Income</h6>
                        <h3 class="mb-0 text-success">$8,500</h3>
                        <small class="text-success">+15% from last month</small>
                    </div>
                    <div class="text-success">
                        <i class="fas fa-arrow-up fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-muted mb-1">Total Expenses</h6>
                        <h3 class="mb-0 text-danger">$6,400</h3>
                        <small class="text-danger">-8% from last month</small>
                    </div>
                    <div class="text-danger">
                        <i class="fas fa-arrow-down fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-muted mb-1">Net Savings</h6>
                        <h3 class="mb-0 text-primary">$2,100</h3>
                        <small class="text-primary">25% savings rate</small>
                    </div>
                    <div class="text-primary">
                        <i class="fas fa-piggy-bank fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-muted mb-1">Transactions</h6>
                        <h3 class="mb-0">45</h3>
                        <small class="text-muted">This month</small>
                    </div>
                    <div class="text-muted">
                        <i class="fas fa-exchange-alt fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row mb-4">
    <div class="col-xl-8 mb-3">
        <div class="card">
            <div class="card-header bg-transparent">
                <h5 class="card-title mb-0">Income vs Expenses Trend</h5>
            </div>
            <div class="card-body">
                <canvas id="trendChart" height="100"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-xl-4 mb-3">
        <div class="card">
            <div class="card-header bg-transparent">
                <h5 class="card-title mb-0">Category Distribution</h5>
            </div>
            <div class="card-body">
                <canvas id="categoryChart" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Detailed Analysis -->
<div class="row">
    <div class="col-xl-6 mb-4">
        <div class="card">
            <div class="card-header bg-transparent">
                <h5 class="card-title mb-0">Top Spending Categories</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="category-color bg-danger me-3" style="width: 20px; height: 20px; border-radius: 4px;"></div>
                                        <span>Food & Dining</span>
                                    </div>
                                </td>
                                <td class="text-end">$800</td>
                                <td class="text-end text-muted">25%</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="category-color bg-warning me-3" style="width: 20px; height: 20px; border-radius: 4px;"></div>
                                        <span>Transportation</span>
                                    </div>
                                </td>
                                <td class="text-end">$400</td>
                                <td class="text-end text-muted">12.5%</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="category-color bg-info me-3" style="width: 20px; height: 20px; border-radius: 4px;"></div>
                                        <span>Entertainment</span>
                                    </div>
                                </td>
                                <td class="text-end">$600</td>
                                <td class="text-end text-muted">18.75%</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="category-color bg-primary me-3" style="width: 20px; height: 20px; border-radius: 4px;"></div>
                                        <span>Shopping</span>
                                    </div>
                                </td>
                                <td class="text-end">$300</td>
                                <td class="text-end text-muted">9.375%</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="category-color bg-secondary me-3" style="width: 20px; height: 20px; border-radius: 4px;"></div>
                                        <span>Healthcare</span>
                                    </div>
                                </td>
                                <td class="text-end">$200</td>
                                <td class="text-end text-muted">6.25%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-6 mb-4">
        <div class="card">
            <div class="card-header bg-transparent">
                <h5 class="card-title mb-0">Monthly Comparison</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Month</th>
                                <th class="text-end">Income</th>
                                <th class="text-end">Expenses</th>
                                <th class="text-end">Savings</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>December 2024</td>
                                <td class="text-end text-success">$8,500</td>
                                <td class="text-end text-danger">$6,400</td>
                                <td class="text-end text-primary">$2,100</td>
                            </tr>
                            <tr>
                                <td>November 2024</td>
                                <td class="text-end text-success">$7,800</td>
                                <td class="text-end text-danger">$6,800</td>
                                <td class="text-end text-primary">$1,000</td>
                            </tr>
                            <tr>
                                <td>October 2024</td>
                                <td class="text-end text-success">$8,200</td>
                                <td class="text-end text-danger">$7,100</td>
                                <td class="text-end text-primary">$1,100</td>
                            </tr>
                            <tr>
                                <td>September 2024</td>
                                <td class="text-end text-success">$7,500</td>
                                <td class="text-end text-danger">$6,200</td>
                                <td class="text-end text-primary">$1,300</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Savings Analysis -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-transparent">
                <h5 class="card-title mb-0">Savings Analysis</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Savings Rate Trend</h6>
                        <div class="progress mb-2" style="height: 20px;">
                            <div class="progress-bar bg-success" style="width: 25%">25%</div>
                        </div>
                        <small class="text-muted">Current month savings rate</small>
                        
                        <div class="mt-3">
                            <h6>Savings Goals Progress</h6>
                            <div class="mb-2">
                                <div class="d-flex justify-content-between">
                                    <span>Emergency Fund</span>
                                    <span>$8,000 / $10,000</span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-primary" style="width: 80%"></div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="d-flex justify-content-between">
                                    <span>Vacation Fund</span>
                                    <span>$2,500 / $5,000</span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-warning" style="width: 50%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6>Spending Insights</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-arrow-down text-success me-2"></i>
                                <strong>Food spending decreased</strong> by 12% compared to last month
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-arrow-up text-warning me-2"></i>
                                <strong>Entertainment spending increased</strong> by 8% this month
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                <strong>You're on track</strong> to meet your monthly budget goals
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-lightbulb text-info me-2"></i>
                                <strong>Tip:</strong> Consider reducing entertainment spending to increase savings
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Trend Chart
const trendCtx = document.getElementById('trendChart').getContext('2d');
new Chart(trendCtx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'Income',
            data: [7500, 8000, 8200, 7800, 8500, 9000, 8700, 9200, 8800, 9500, 9200, 8500],
            borderColor: '#10B981',
            backgroundColor: 'rgba(16, 185, 129, 0.1)',
            tension: 0.4,
            fill: true
        }, {
            label: 'Expenses',
            data: [6200, 6800, 7100, 6500, 7200, 7800, 7400, 8000, 7600, 8200, 7900, 6400],
            borderColor: '#EF4444',
            backgroundColor: 'rgba(239, 68, 68, 0.1)',
            tension: 0.4,
            fill: true
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
                beginAtZero: true
            }
        }
    }
});

// Category Chart
const categoryCtx = document.getElementById('categoryChart').getContext('2d');
new Chart(categoryCtx, {
    type: 'doughnut',
    data: {
        labels: ['Food', 'Transport', 'Entertainment', 'Shopping', 'Healthcare', 'Other'],
        datasets: [{
            data: [25, 12.5, 18.75, 9.375, 6.25, 28.125],
            backgroundColor: [
                '#EF4444',
                '#F59E0B',
                '#06B6D4',
                '#3B82F6',
                '#6B7280',
                '#8B5CF6'
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
</script>
@endpush 