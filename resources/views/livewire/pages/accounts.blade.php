<div class="accounts-container">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Accounts</h4>
            <p class="text-muted mb-0">Manage your bank and cash accounts</p>
        </div>
        <button class="btn btn-primary" wire:click="$set('showAccountModal', true)">
            <i class="fas fa-plus me-2"></i>Add Account
        </button>
    </div>

    <!-- Account Summary Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-muted mb-1">Total Balance</h6>
                            <h3 class="mb-0">${{ number_format($accounts->sum('balance'), 2) }}</h3>
                            <small class="text-success">+${{ number_format($accounts->where('balance', '>', 0)->sum('balance'), 2) }} positive</small>
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
                            <h3 class="mb-0">{{ $accounts->count() }}</h3>
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
                            <h3 class="mb-0">${{ $accounts->count() > 0 ? number_format($accounts->max('balance'), 2) : '0.00' }}</h3>
                            <small class="text-muted">{{ $accounts->count() > 0 ? $accounts->where('balance', $accounts->max('balance'))->first()->name : 'No accounts' }}</small>
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
                            <h3 class="mb-0 text-danger">${{ number_format(abs($accounts->where('balance', '<', 0)->sum('balance')), 2) }}</h3>
                            <small class="text-danger">Credit accounts</small>
                        </div>
                        <div class="text-danger">
                            <i class="fas fa-credit-card fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Accounts Table -->
    <div class="card mb-4">
        <div class="card-header bg-transparent">
            <h5 class="card-title mb-0">All Accounts</h5>
        </div>
        <div class="card-body p-0">
            @if($accounts->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Account</th>
                                <th>Type</th>
                                <th>Balance</th>
                                <th>Currency</th>
                                <th>Status</th>
                                <th>Last Updated</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($accounts as $account)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="account-icon bg-{{ $account->type === 'bank' ? 'success' : ($account->type === 'credit' ? 'warning' : 'primary') }} text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                                <i class="fas fa-{{ $account->type === 'bank' ? 'university' : ($account->type === 'credit' ? 'credit-card' : 'money-bill-wave') }}"></i>
                                            </div>
<div>
                                                <h6 class="mb-0">{{ $account->name }}</h6>
                                                <small class="text-muted">{{ ucfirst($account->type) }} account</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-{{ $account->type === 'bank' ? 'info' : ($account->type === 'credit' ? 'warning' : 'primary') }}">{{ ucfirst($account->type) }}</span></td>
                                    <td class="{{ $account->balance >= 0 ? 'text-success' : 'text-danger' }} fw-bold">${{ number_format($account->balance, 2) }}</td>
                                    <td>USD</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>{{ $account->updated_at->format('M d, Y') }}</td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary" wire:click="editAccount({{ $account->id }})" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-outline-info" title="View Transactions">
                                                <i class="fas fa-list"></i>
                                            </button>
                                            <button class="btn btn-outline-danger" wire:click="deleteAccount({{ $account->id }})" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-wallet fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No accounts found</h5>
                    <p class="text-muted">Start by adding your first account to track your finances.</p>
                    <button class="btn btn-primary" wire:click="$set('showAccountModal', true)">
                        <i class="fas fa-plus me-2"></i>Add Your First Account
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Add/Edit Account Modal -->
    <div class="modal fade @if($showAccountModal) show d-block @endif" tabindex="-1" style="@if($showAccountModal) display: block; background: rgba(0,0,0,0.5); @else display: none; @endif" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit.prevent="saveAccount">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $editingAccountId ? 'Edit Account' : 'Add Account' }}</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Account Name</label>
                            <input type="text" class="form-control @error('accountForm.name') is-invalid @enderror" wire:model.defer="accountForm.name">
                            @error('accountForm.name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Account Type</label>
                            <select class="form-select @error('accountForm.type') is-invalid @enderror" wire:model.defer="accountForm.type">
                                <option value="">Select Type</option>
                                <option value="bank">Bank Account</option>
                                <option value="credit">Credit Card</option>
                                <option value="cash">Cash</option>
                                <option value="investment">Investment</option>
                                <option value="savings">Savings</option>
                            </select>
                            @error('accountForm.type') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Initial Balance</label>
                            <input type="number" step="0.01" class="form-control @error('accountForm.balance') is-invalid @enderror" wire:model.defer="accountForm.balance">
                            @error('accountForm.balance') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancel</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="saveAccount">
                            <span wire:loading wire:target="saveAccount" class="spinner-border spinner-border-sm me-2"></span>
                            {{ $editingAccountId ? 'Update' : 'Add' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .accounts-container {
            padding: 1.5rem;
        }
        .modal.show.d-block {
            display: block !important;
        }
        .modal-backdrop {
            display: none;
        }
        .account-icon {
            min-width: 40px;
        }
    </style>
</div>


