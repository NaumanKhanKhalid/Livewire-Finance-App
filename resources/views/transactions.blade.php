@extends('layouts.app')

@section('title', 'Transactions')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Transactions</h1>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTransactionModal">
                <i class="fas fa-plus me-2"></i>Add Transaction
            </button>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 mb-3">
                <label class="form-label">Type</label>
                <select class="form-select">
                    <option value="">All Types</option>
                    <option value="income">Income</option>
                    <option value="expense">Expense</option>
                    <option value="transfer">Transfer</option>
                </select>
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
            <div class="col-md-3 mb-3">
                <label class="form-label">Account</label>
                <select class="form-select">
                    <option value="">All Accounts</option>
                    <option value="cash">Cash</option>
                    <option value="bank">Bank Account</option>
                    <option value="credit">Credit Card</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Date Range</label>
                <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary me-2">Apply Filters</button>
                <button class="btn btn-outline-secondary">Clear Filters</button>
            </div>
        </div>
    </div>
</div>

<!-- Transactions Table -->
<div class="card">
    <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">All Transactions</h5>
        <div class="d-flex gap-2">
            <button class="btn btn-sm btn-outline-primary">
                <i class="fas fa-download me-1"></i>Export
            </button>
            <div class="dropdown">
                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i>Bulk Edit</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-trash me-2"></i>Bulk Delete</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>
                            <input type="checkbox" class="form-check-input" id="selectAll">
                        </th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Account</th>
                        <th class="text-end">Amount</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>Dec 15, 2024</td>
                        <td><span class="badge bg-danger">Expense</span></td>
                        <td><span class="badge bg-danger">Food</span></td>
                        <td>Grocery shopping at Walmart</td>
                        <td>Credit Card</td>
                        <td class="text-end text-danger">-$85.00</td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-outline-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>Dec 14, 2024</td>
                        <td><span class="badge bg-success">Income</span></td>
                        <td><span class="badge bg-success">Salary</span></td>
                        <td>Monthly salary payment</td>
                        <td>Bank Account</td>
                        <td class="text-end text-success">+$3,000.00</td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-outline-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>Dec 13, 2024</td>
                        <td><span class="badge bg-danger">Expense</span></td>
                        <td><span class="badge bg-warning">Transport</span></td>
                        <td>Uber ride to work</td>
                        <td>Credit Card</td>
                        <td class="text-end text-danger">-$25.50</td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-outline-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>Dec 12, 2024</td>
                        <td><span class="badge bg-danger">Expense</span></td>
                        <td><span class="badge bg-info">Entertainment</span></td>
                        <td>Netflix subscription</td>
                        <td>Credit Card</td>
                        <td class="text-end text-danger">-$15.99</td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-outline-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>Dec 11, 2024</td>
                        <td><span class="badge bg-danger">Expense</span></td>
                        <td><span class="badge bg-primary">Shopping</span></td>
                        <td>Amazon purchase</td>
                        <td>Credit Card</td>
                        <td class="text-end text-danger">-$120.00</td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-outline-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>Dec 10, 2024</td>
                        <td><span class="badge bg-success">Income</span></td>
                        <td><span class="badge bg-success">Freelance</span></td>
                        <td>Web design project</td>
                        <td>Bank Account</td>
                        <td class="text-end text-success">+$500.00</td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-outline-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td>Dec 09, 2024</td>
                        <td><span class="badge bg-danger">Expense</span></td>
                        <td><span class="badge bg-secondary">Healthcare</span></td>
                        <td>Doctor appointment</td>
                        <td>Cash</td>
                        <td class="text-end text-danger">-$75.00</td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
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
    <div class="card-footer">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                Showing 1-7 of 45 transactions
            </div>
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
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