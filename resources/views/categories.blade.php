@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Categories</h1>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                <i class="fas fa-plus me-2"></i>Add Category
            </button>
        </div>
    </div>
</div>

<!-- Category Summary -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-muted mb-1">Total Categories</h6>
                        <h3 class="mb-0">14</h3>
                        <small class="text-muted">Active categories</small>
                    </div>
                    <div class="text-primary">
                        <i class="fas fa-tags fa-2x"></i>
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
                        <h6 class="card-title text-muted mb-1">Income Categories</h6>
                        <h3 class="mb-0 text-success">4</h3>
                        <small class="text-success">Salary, Freelance, etc.</small>
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
                        <h6 class="card-title text-muted mb-1">Expense Categories</h6>
                        <h3 class="mb-0 text-danger">10</h3>
                        <small class="text-danger">Food, Transport, etc.</small>
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
                        <h6 class="card-title text-muted mb-1">Most Used</h6>
                        <h3 class="mb-0">Food</h3>
                        <small class="text-muted">25% of transactions</small>
                    </div>
                    <div class="text-warning">
                        <i class="fas fa-utensils fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Categories Grid -->
<div class="row">
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-header bg-transparent">
                <h5 class="card-title mb-0">Income Categories</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-3">
                        <div class="category-card card h-100">
                            <div class="card-body text-center">
                                <div class="category-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                                    <i class="fas fa-money-bill-wave fa-2x"></i>
                                </div>
                                <h6 class="card-title">Salary</h6>
                                <p class="text-muted mb-2">Monthly salary payments</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-success fw-bold">$3,000</span>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary btn-sm">Edit</button>
                                        <button class="btn btn-outline-danger btn-sm">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6 mb-3">
                        <div class="category-card card h-100">
                            <div class="card-body text-center">
                                <div class="category-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                                    <i class="fas fa-laptop fa-2x"></i>
                                </div>
                                <h6 class="card-title">Freelance</h6>
                                <p class="text-muted mb-2">Freelance work income</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-success fw-bold">$500</span>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary btn-sm">Edit</button>
                                        <button class="btn btn-outline-danger btn-sm">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6 mb-3">
                        <div class="category-card card h-100">
                            <div class="card-body text-center">
                                <div class="category-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                                    <i class="fas fa-chart-line fa-2x"></i>
                                </div>
                                <h6 class="card-title">Investment</h6>
                                <p class="text-muted mb-2">Investment returns</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-success fw-bold">$200</span>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary btn-sm">Edit</button>
                                        <button class="btn btn-outline-danger btn-sm">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6 mb-3">
                        <div class="category-card card h-100">
                            <div class="card-body text-center">
                                <div class="category-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                                    <i class="fas fa-plus-circle fa-2x"></i>
                                </div>
                                <h6 class="card-title">Other Income</h6>
                                <p class="text-muted mb-2">Miscellaneous income</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-success fw-bold">$100</span>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary btn-sm">Edit</button>
                                        <button class="btn btn-outline-danger btn-sm">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-header bg-transparent">
                <h5 class="card-title mb-0">Expense Categories</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-3">
                        <div class="category-card card h-100">
                            <div class="card-body text-center">
                                <div class="category-icon bg-danger text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                                    <i class="fas fa-utensils fa-2x"></i>
                                </div>
                                <h6 class="card-title">Food & Dining</h6>
                                <p class="text-muted mb-2">Restaurants and groceries</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-danger fw-bold">$800</span>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary btn-sm">Edit</button>
                                        <button class="btn btn-outline-danger btn-sm">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6 mb-3">
                        <div class="category-card card h-100">
                            <div class="card-body text-center">
                                <div class="category-icon bg-warning text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                                    <i class="fas fa-car fa-2x"></i>
                                </div>
                                <h6 class="card-title">Transportation</h6>
                                <p class="text-muted mb-2">Gas, Uber, public transport</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-danger fw-bold">$400</span>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary btn-sm">Edit</button>
                                        <button class="btn btn-outline-danger btn-sm">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6 mb-3">
                        <div class="category-card card h-100">
                            <div class="card-body text-center">
                                <div class="category-icon bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                                    <i class="fas fa-shopping-bag fa-2x"></i>
                                </div>
                                <h6 class="card-title">Shopping</h6>
                                <p class="text-muted mb-2">Clothes, electronics, etc.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-danger fw-bold">$300</span>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary btn-sm">Edit</button>
                                        <button class="btn btn-outline-danger btn-sm">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6 mb-3">
                        <div class="category-card card h-100">
                            <div class="card-body text-center">
                                <div class="category-icon bg-info text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                                    <i class="fas fa-gamepad fa-2x"></i>
                                </div>
                                <h6 class="card-title">Entertainment</h6>
                                <p class="text-muted mb-2">Movies, games, hobbies</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-danger fw-bold">$600</span>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary btn-sm">Edit</button>
                                        <button class="btn btn-outline-danger btn-sm">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6 mb-3">
                        <div class="category-card card h-100">
                            <div class="card-body text-center">
                                <div class="category-icon bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                                    <i class="fas fa-heartbeat fa-2x"></i>
                                </div>
                                <h6 class="card-title">Healthcare</h6>
                                <p class="text-muted mb-2">Medical expenses</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-danger fw-bold">$200</span>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary btn-sm">Edit</button>
                                        <button class="btn btn-outline-danger btn-sm">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6 mb-3">
                        <div class="category-card card h-100">
                            <div class="card-body text-center">
                                <div class="category-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                                    <i class="fas fa-graduation-cap fa-2x"></i>
                                </div>
                                <h6 class="card-title">Education</h6>
                                <p class="text-muted mb-2">Courses and books</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-danger fw-bold">$150</span>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary btn-sm">Edit</button>
                                        <button class="btn btn-outline-danger btn-sm">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6 mb-3">
                        <div class="category-card card h-100">
                            <div class="card-body text-center">
                                <div class="category-icon bg-warning text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                                    <i class="fas fa-home fa-2x"></i>
                                </div>
                                <h6 class="card-title">Housing</h6>
                                <p class="text-muted mb-2">Rent and utilities</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-danger fw-bold">$1,200</span>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary btn-sm">Edit</button>
                                        <button class="btn btn-outline-danger btn-sm">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6 mb-3">
                        <div class="category-card card h-100">
                            <div class="card-body text-center">
                                <div class="category-icon bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                                    <i class="fas fa-bolt fa-2x"></i>
                                </div>
                                <h6 class="card-title">Utilities</h6>
                                <p class="text-muted mb-2">Electricity, water, internet</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-danger fw-bold">$300</span>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary btn-sm">Edit</button>
                                        <button class="btn btn-outline-danger btn-sm">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Category Name</label>
                        <input type="text" class="form-control" placeholder="Enter category name">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="type" id="income" value="income">
                            <label class="btn btn-outline-success" for="income">Income</label>
                            
                            <input type="radio" class="btn-check" name="type" id="expense" value="expense" checked>
                            <label class="btn btn-outline-danger" for="expense">Expense</label>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Color</label>
                        <div class="d-flex gap-2 flex-wrap">
                            <input type="radio" class="btn-check" name="color" id="red" value="#EF4444">
                            <label class="btn btn-outline-danger" for="red" style="width: 40px; height: 40px;"></label>
                            
                            <input type="radio" class="btn-check" name="color" id="blue" value="#3B82F6">
                            <label class="btn btn-outline-primary" for="blue" style="width: 40px; height: 40px;"></label>
                            
                            <input type="radio" class="btn-check" name="color" id="green" value="#10B981">
                            <label class="btn btn-outline-success" for="green" style="width: 40px; height: 40px;"></label>
                            
                            <input type="radio" class="btn-check" name="color" id="yellow" value="#F59E0B">
                            <label class="btn btn-outline-warning" for="yellow" style="width: 40px; height: 40px;"></label>
                            
                            <input type="radio" class="btn-check" name="color" id="purple" value="#8B5CF6">
                            <label class="btn btn-outline-secondary" for="purple" style="width: 40px; height: 40px;"></label>
                            
                            <input type="radio" class="btn-check" name="color" id="pink" value="#EC4899">
                            <label class="btn btn-outline-info" for="pink" style="width: 40px; height: 40px;"></label>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Icon</label>
                        <select class="form-select">
                            <option value="fas fa-utensils">🍽️ Food & Dining</option>
                            <option value="fas fa-car">🚗 Transportation</option>
                            <option value="fas fa-shopping-bag">🛍️ Shopping</option>
                            <option value="fas fa-gamepad">🎮 Entertainment</option>
                            <option value="fas fa-heartbeat">❤️ Healthcare</option>
                            <option value="fas fa-graduation-cap">🎓 Education</option>
                            <option value="fas fa-home">🏠 Housing</option>
                            <option value="fas fa-bolt">⚡ Utilities</option>
                            <option value="fas fa-money-bill-wave">💰 Salary</option>
                            <option value="fas fa-laptop">💻 Freelance</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Description (Optional)</label>
                        <textarea class="form-control" rows="3" placeholder="Enter category description..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Create Category</button>
            </div>
        </div>
    </div>
    @push('styles')
<style>
.category-card {
    transition: all 0.3s ease;
    border: 1px solid #e5e7eb;
}

.category-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
}

.category-icon {
    transition: all 0.3s ease;
}

.category-card:hover .category-icon {
    transform: scale(1.1);
}
</style>
@endpush 
</div>

@endsection

