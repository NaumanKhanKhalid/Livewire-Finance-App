@extends('layouts.app')

@section('title', 'Budgets')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Budgets</h1>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createBudgetModal">
                <i class="fas fa-plus me-2"></i>Create Budget
            </button>
        </div>
    </div>
</div>

<!-- Budget Overview Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-muted mb-1">Total Budget</h6>
                        <h3 class="mb-0">$3,000</h3>
                        <small class="text-muted">December 2024</small>
                    </div>
                    <div class="text-primary">
                        <i class="fas fa-chart-pie fa-2x"></i>
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
                        <h6 class="card-title text-muted mb-1">Spent</h6>
                        <h3 class="mb-0 text-danger">$1,800</h3>
                        <small class="text-muted">60% of budget</small>
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
                        <h6 class="card-title text-muted mb-1">Remaining</h6>
                        <h3 class="mb-0 text-success">$1,200</h3>
                        <small class="text-muted">40% left</small>
                    </div>
                    <div class="text-success">
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
                        <h6 class="card-title text-muted mb-1">Daily Average</h6>
                        <h3 class="mb-0">$60</h3>
                        <small class="text-muted">$2/day remaining</small>
                    </div>
                    <div class="text-warning">
                        <i class="fas fa-calendar-day fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Budget Period Selector -->
<div class="card mb-4">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5 class="mb-0">December 2024 Budget</h5>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-primary active">Monthly</button>
                    <button type="button" class="btn btn-outline-primary">Yearly</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Budget Categories -->
<div class="row">
    <div class="col-xl-8 mb-4">
        <div class="card">
            <div class="card-header bg-transparent">
                <h5 class="card-title mb-0">Budget Categories</h5>
            </div>
            <div class="card-body">
                <div class="budget-item mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center">
                            <div class="budget-icon bg-danger text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                <i class="fas fa-utensils"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Food & Dining</h6>
                                <small class="text-muted">$800 spent of $1,000</small>
                            </div>
                        </div>
                        <div class="text-end">
                            <h6 class="mb-0">80%</h6>
                            <small class="text-danger">$200 remaining</small>
                        </div>
                    </div>
                    <div class="progress mb-2" style="height: 10px;">
                        <div class="progress-bar bg-danger" style="width: 80%"></div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <small class="text-muted">Daily average: $26.67</small>
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-outline-primary btn-sm">Edit</button>
                            <button class="btn btn-outline-danger btn-sm">Delete</button>
                        </div>
                    </div>
                </div>

                <div class="budget-item mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center">
                            <div class="budget-icon bg-warning text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                <i class="fas fa-car"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Transportation</h6>
                                <small class="text-muted">$400 spent of $1,000</small>
                            </div>
                        </div>
                        <div class="text-end">
                            <h6 class="mb-0">40%</h6>
                            <small class="text-success">$600 remaining</small>
                        </div>
                    </div>
                    <div class="progress mb-2" style="height: 10px;">
                        <div class="progress-bar bg-warning" style="width: 40%"></div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <small class="text-muted">Daily average: $13.33</small>
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-outline-primary btn-sm">Edit</button>
                            <button class="btn btn-outline-danger btn-sm">Delete</button>
                        </div>
                    </div>
                </div>

                <div class="budget-item mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center">
                            <div class="budget-icon bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                <i class="fas fa-gamepad"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Entertainment</h6>
                                <small class="text-muted">$600 spent of $1,000</small>
                            </div>
                        </div>
                        <div class="text-end">
                            <h6 class="mb-0">60%</h6>
                            <small class="text-warning">$400 remaining</small>
                        </div>
                    </div>
                    <div class="progress mb-2" style="height: 10px;">
                        <div class="progress-bar bg-info" style="width: 60%"></div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <small class="text-muted">Daily average: $20.00</small>
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-outline-primary btn-sm">Edit</button>
                            <button class="btn btn-outline-danger btn-sm">Delete</button>
                        </div>
                    </div>
                </div>

                <div class="budget-item mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center">
                            <div class="budget-icon bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Shopping</h6>
                                <small class="text-muted">$300 spent of $800</small>
                            </div>
                        </div>
                        <div class="text-end">
                            <h6 class="mb-0">37.5%</h6>
                            <small class="text-success">$500 remaining</small>
                        </div>
                    </div>
                    <div class="progress mb-2" style="height: 10px;">
                        <div class="progress-bar bg-primary" style="width: 37.5%"></div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <small class="text-muted">Daily average: $10.00</small>
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-outline-primary btn-sm">Edit</button>
                            <button class="btn btn-outline-danger btn-sm">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 mb-4">
        <div class="card">
            <div class="card-header bg-transparent">
                <h5 class="card-title mb-0">Budget Alerts</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-warning d-flex align-items-center mb-3">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <div>
                        <strong>Food & Dining</strong> is at 80% of budget
                    </div>
                </div>
                
                <div class="alert alert-info d-flex align-items-center mb-3">
                    <i class="fas fa-info-circle me-2"></i>
                    <div>
                        <strong>Entertainment</strong> is at 60% of budget
                    </div>
                </div>
                
                <div class="alert alert-success d-flex align-items-center">
                    <i class="fas fa-check-circle me-2"></i>
                    <div>
                        <strong>Transportation</strong> is on track
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-transparent">
                <h5 class="card-title mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <button class="btn btn-primary w-100 mb-2">
                    <i class="fas fa-plus me-2"></i>Add New Budget
                </button>
                <button class="btn btn-outline-primary w-100 mb-2">
                    <i class="fas fa-download me-2"></i>Export Budget Report
                </button>
                <button class="btn btn-outline-secondary w-100">
                    <i class="fas fa-cog me-2"></i>Budget Settings
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Create Budget Modal -->
<div class="modal fade" id="createBudgetModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Budget</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select class="form-select">
                            <option>Select Category</option>
                            <option>Food & Dining</option>
                            <option>Transportation</option>
                            <option>Shopping</option>
                            <option>Entertainment</option>
                            <option>Healthcare</option>
                            <option>Education</option>
                            <option>Housing</option>
                            <option>Utilities</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Budget Amount</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" placeholder="0.00" step="0.01">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Period</label>
                        <select class="form-select">
                            <option value="monthly">Monthly</option>
                            <option value="yearly">Yearly</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Start Date</label>
                        <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">End Date</label>
                        <input type="date" class="form-control">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Description (Optional)</label>
                        <textarea class="form-control" rows="3" placeholder="Enter budget description..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Create Budget</button>
            </div>
        </div>
    </div>
</div>
@endsection 