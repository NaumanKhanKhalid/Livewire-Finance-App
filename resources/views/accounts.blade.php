@extends('layouts.app')

@section('title', 'Accounts')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Accounts</h1>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAccountModal">
                <i class="fas fa-plus me-2"></i>Add Account
            </button>
        </div>
    </div>
</div>

<!-- Account Summary -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-muted mb-1">Total Balance</h6>
                        <h3 class="mb-0">$12,450</h3>
                        <small class="text-success">+$2,100 this month</small>
                    </div>
                    <div class="text-primary">
                        <i class="fas fa-wallet fa-2x"></i>
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
                        <h6 class="card-title text-muted mb-1">Active Accounts</h6>
                        <h3 class="mb-0">3</h3>
                        <small class="text-muted">Total accounts</small>
                    </div>
                    <div class="text-success">
                        <i class="fas fa-check-circle fa-2x"></i>
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
                        <h6 class="card-title text-muted mb-1">Largest Balance</h6>
                        <h3 class="mb-0">$9,950</h3>
                        <small class="text-muted">Bank Account</small>
                    </div>
                    <div class="text-info">
                        <i class="fas fa-university fa-2x"></i>
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
                        <h6 class="card-title text-muted mb-1">Total Debt</h6>
                        <h3 class="mb-0 text-danger">$2,500</h3>
                        <small class="text-danger">Credit Card</small>
                    </div>
                    <div class="text-danger">
                        <i class="fas fa-credit-card fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Accounts List -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-transparent">
                <h5 class="card-title mb-0">All Accounts</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Account</th>
                                <th>Type</th>
                                <th>Balance</th>
                                <th>Currency</th>
                                <th>Status</th>
                                <th>Last Transaction</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="account-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                            <i class="fas fa-university"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Bank Account</h6>
                                            <small class="text-muted">Main checking account</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-info">Bank</span></td>
                                <td class="text-success fw-bold">$9,950.00</td>
                                <td>USD</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>Dec 14, 2024</td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-outline-info" title="View Transactions">
                                            <i class="fas fa-list"></i>
                                        </button>
                                        <button class="btn btn-outline-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="account-icon bg-warning text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                            <i class="fas fa-credit-card"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Credit Card</h6>
                                            <small class="text-muted">Visa ending in 1234</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-warning">Credit</span></td>
                                <td class="text-danger fw-bold">-$2,500.00</td>
                                <td>USD</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>Dec 15, 2024</td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-outline-info" title="View Transactions">
                                            <i class="fas fa-list"></i>
                                        </button>
                                        <button class="btn btn-outline-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="account-icon bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                            <i class="fas fa-money-bill-wave"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Cash</h6>
                                            <small class="text-muted">Physical cash</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-primary">Cash</span></td>
                                <td class="text-success fw-bold">$0.00</td>
                                <td>USD</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>Dec 09, 2024</td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-outline-info" title="View Transactions">
                                            <i class="fas fa-list"></i>
                                        </button>
                                        <button class="btn btn-outline-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Account Types Overview -->
<div class="row mt-4">
    <div class="col-xl-6 mb-4">
        <div class="card">
            <div class="card-header bg-transparent">
                <h5 class="card-title mb-0">Account Types Distribution</h5>
            </div>
            <div class="card-body">
                <canvas id="accountTypesChart" height="200"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-xl-6 mb-4">
        <div class="card">
            <div class="card-header bg-transparent">
                <h5 class="card-title mb-0">Recent Account Activity</h5>
            </div>
            <div class="card-body">
                <div class="activity-item d-flex align-items-center mb-3">
                    <div class="activity-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px;">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-bold">Salary deposited</div>
                        <small class="text-muted">Bank Account • Dec 14, 2024</small>
                    </div>
                    <div class="text-success">+$3,000</div>
                </div>
                
                <div class="activity-item d-flex align-items-center mb-3">
                    <div class="activity-icon bg-danger text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px;">
                        <i class="fas fa-minus"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-bold">Grocery purchase</div>
                        <small class="text-muted">Credit Card • Dec 15, 2024</small>
                    </div>
                    <div class="text-danger">-$85</div>
                </div>
                
                <div class="activity-item d-flex align-items-center mb-3">
                    <div class="activity-icon bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px;">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-bold">Account created</div>
                        <small class="text-muted">Cash Account • Dec 01, 2024</small>
                    </div>
                    <div class="text-info">New</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Account Modal -->
<div class="modal fade" id="addAccountModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Account Name</label>
                        <input type="text" class="form-control" placeholder="Enter account name">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Account Type</label>
                        <select class="form-select">
                            <option>Select Account Type</option>
                            <option value="cash">Cash</option>
                            <option value="bank">Bank Account</option>
                            <option value="credit">Credit Card</option>
                            <option value="investment">Investment</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Initial Balance</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" placeholder="0.00" step="0.01">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Currency</label>
                        <select class="form-select">
                            <option value="USD">USD - US Dollar</option>
                            <option value="EUR">EUR - Euro</option>
                            <option value="GBP">GBP - British Pound</option>
                            <option value="JPY">JPY - Japanese Yen</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Description (Optional)</label>
                        <textarea class="form-control" rows="3" placeholder="Enter account description..."></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="isActive" checked>
                            <label class="form-check-label" for="isActive">
                                Account is active
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Create Account</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Account Types Chart
const accountTypesCtx = document.getElementById('accountTypesChart').getContext('2d');
new Chart(accountTypesCtx, {
    type: 'doughnut',
    data: {
        labels: ['Bank Account', 'Credit Card', 'Cash'],
        datasets: [{
            data: [79.9, 20.0, 0.1],
            backgroundColor: [
                '#10B981',
                '#F59E0B',
                '#3B82F6'
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