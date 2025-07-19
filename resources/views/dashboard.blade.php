@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Dashboard</h1>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTransactionModal">
                <i class="fas fa-plus me-2"></i>Add Transaction
            </button>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card stats-card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-white-50 mb-1">Total Balance</h6>
                        <h3 class="mb-0 text-white">$12,450</h3>
                        <small class="text-white-50">+$2,100 this month</small>
                    </div>
                    <div class="text-white-50">
                        <i class="fas fa-wallet fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card stats-card income h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-white-50 mb-1">Monthly Income</h6>
                        <h3 class="mb-0 text-white">$8,500</h3>
                        <small class="text-white-50">+15% from last month</small>
                    </div>
                    <div class="text-white-50">
                        <i class="fas fa-arrow-up fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card stats-card expense h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-white-50 mb-1">Monthly Expenses</h6>
                        <h3 class="mb-0 text-white">$6,400</h3>
                        <small class="text-white-50">-8% from last month</small>
                    </div>
                    <div class="text-white-50">
                        <i class="fas fa-arrow-down fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-muted mb-1">Savings Rate</h6>
                        <h3 class="mb-0 text-success">25%</h3>
                        <small class="text-muted">$2,100 saved</small>
                    </div>
                    <div class="text-success">
                        <i class="fas fa-piggy-bank fa-2x"></i>
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
                <h5 class="card-title mb-0">Monthly Spending Overview</h5>
            </div>
            <div class="card-body">
                <canvas id="monthlyChart" height="100"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-xl-4 mb-3">
        <div class="card">
            <div class="card-header bg-transparent">
                <h5 class="card-title mb-0">Category Breakdown</h5>
            </div>
            <div class="card-body">
                <canvas id="categoryChart" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Recent Transactions & Budget Status -->
<div class="row">
    <div class="col-xl-8 mb-3">
        <div class="card">
            <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Recent Transactions</h5>
                <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Account</th>
                                <th class="text-end">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Dec 15, 2024</td>
                                <td><span class="badge bg-danger">Food</span></td>
                                <td>Grocery shopping at Walmart</td>
                                <td>Credit Card</td>
                                <td class="text-end text-danger">-$85.00</td>
                            </tr>
                            <tr>
                                <td>Dec 14, 2024</td>
                                <td><span class="badge bg-success">Salary</span></td>
                                <td>Monthly salary payment</td>
                                <td>Bank Account</td>
                                <td class="text-end text-success">+$3,000.00</td>
                            </tr>
                            <tr>
                                <td>Dec 13, 2024</td>
                                <td><span class="badge bg-warning">Transport</span></td>
                                <td>Uber ride to work</td>
                                <td>Credit Card</td>
                                <td class="text-end text-danger">-$25.50</td>
                            </tr>
                            <tr>
                                <td>Dec 12, 2024</td>
                                <td><span class="badge bg-info">Entertainment</span></td>
                                <td>Netflix subscription</td>
                                <td>Credit Card</td>
                                <td class="text-end text-danger">-$15.99</td>
                            </tr>
                            <tr>
                                <td>Dec 11, 2024</td>
                                <td><span class="badge bg-primary">Shopping</span></td>
                                <td>Amazon purchase</td>
                                <td>Credit Card</td>
                                <td class="text-end text-danger">-$120.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-4 mb-3">
        <div class="card">
            <div class="card-header bg-transparent">
                <h5 class="card-title mb-0">Budget Status</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span>Food & Dining</span>
                        <span>$800 / $1,000</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-danger" style="width: 80%"></div>
                    </div>
                    <small class="text-muted">80% used</small>
                </div>
                
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span>Transportation</span>
                        <span>$400 / $1,000</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-warning" style="width: 40%"></div>
                    </div>
                    <small class="text-muted">40% used</small>
                </div>
                
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span>Entertainment</span>
                        <span>$600 / $1,000</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-info" style="width: 60%"></div>
                    </div>
                    <small class="text-muted">60% used</small>
                </div>
                
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span>Shopping</span>
                        <span>$300 / $800</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-primary" style="width: 37.5%"></div>
                    </div>
                    <small class="text-muted">37.5% used</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Transaction Modal -->
<div class="modal fade" id="addTransactionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Transaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="type" id="income" value="income">
                            <label class="btn btn-outline-success" for="income">Income</label>
                            
                            <input type="radio" class="btn-check" name="type" id="expense" value="expense" checked>
                            <label class="btn btn-outline-danger" for="expense">Expense</label>
                            
                            <input type="radio" class="btn-check" name="type" id="transfer" value="transfer">
                            <label class="btn btn-outline-primary" for="transfer">Transfer</label>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" placeholder="0.00" step="0.01">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select class="form-select">
                            <option>Select Category</option>
                            <option>Food & Dining</option>
                            <option>Transportation</option>
                            <option>Shopping</option>
                            <option>Entertainment</option>
                            <option>Healthcare</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Account</label>
                        <select class="form-select">
                            <option>Select Account</option>
                            <option>Cash</option>
                            <option>Bank Account</option>
                            <option>Credit Card</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" rows="3" placeholder="Enter description..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save Transaction</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Monthly Spending Chart
const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
new Chart(monthlyCtx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'Income',
            data: [7500, 8000, 8200, 7800, 8500, 9000, 8700, 9200, 8800, 9500, 9200, 8500],
            borderColor: '#10B981',
            backgroundColor: 'rgba(16, 185, 129, 0.1)',
            tension: 0.4
        }, {
            label: 'Expenses',
            data: [6200, 6800, 7100, 6500, 7200, 7800, 7400, 8000, 7600, 8200, 7900, 6400],
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
                beginAtZero: true
            }
        }
    }
});

// Category Breakdown Chart
const categoryCtx = document.getElementById('categoryChart').getContext('2d');
new Chart(categoryCtx, {
    type: 'doughnut',
    data: {
        labels: ['Food', 'Transport', 'Shopping', 'Entertainment', 'Healthcare', 'Other'],
        datasets: [{
            data: [30, 20, 15, 12, 10, 13],
            backgroundColor: [
                '#EF4444',
                '#F59E0B',
                '#8B5CF6',
                '#EC4899',
                '#06B6D4',
                '#6B7280'
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