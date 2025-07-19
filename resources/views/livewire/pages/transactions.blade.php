<div class="transactions-container">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Transactions</h4>
            <p class="text-muted mb-0">Track your income and expenses</p>
        </div>
        <button class="btn btn-primary" wire:click="$set('showTransactionModal', true)">
            <i class="fas fa-plus me-2"></i>Add Transaction
        </button>
    </div>

    <!-- Transactions Table -->
    <div class="card mb-4">
        <div class="card-body">
            @if($transactions->count() > 0)
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
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->date->format('M d, Y') }}</td>
                                    <td>
<div>
                                            <strong>{{ $transaction->description }}</strong>
                                            @if($transaction->notes)
                                                <small class="text-muted d-block">{{ $transaction->notes }}</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if($transaction->category)
                                            <span class="badge" style="background-color: {{ $transaction->category->color }}; color: #fff;">
                                                <i class="{{ $transaction->category->icon }} me-1"></i>
                                                {{ $transaction->category->name }}
                                            </span>
                                        @else
                                            <span class="text-muted">No category</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($transaction->account)
                                            <span class="badge bg-secondary">{{ $transaction->account->name }}</span>
                                        @else
                                            <span class="text-muted">No account</span>
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
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary" wire:click="editTransaction({{ $transaction->id }})" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-outline-danger" wire:click="deleteTransaction({{ $transaction->id }})" title="Delete">
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
                    <i class="fas fa-exchange-alt fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No transactions found</h5>
                    <p class="text-muted">Start by adding your first transaction.</p>
                    <button class="btn btn-primary" wire:click="$set('showTransactionModal', true)">
                        <i class="fas fa-plus me-2"></i>Add Your First Transaction
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Add/Edit Transaction Modal -->
    <div class="modal fade @if($showTransactionModal) show d-block @endif" tabindex="-1" style="@if($showTransactionModal) display: block; background: rgba(0,0,0,0.5); @else display: none; @endif" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="saveTransaction">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $editingTransactionId ? 'Edit Transaction' : 'Add Transaction' }}</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <input type="text" class="form-control @error('transactionForm.description') is-invalid @enderror" wire:model.defer="transactionForm.description">
                                    @error('transactionForm.description') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Amount</label>
                                    <input type="number" step="0.01" class="form-control @error('transactionForm.amount') is-invalid @enderror" wire:model.defer="transactionForm.amount">
                                    @error('transactionForm.amount') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Type</label>
                                    <select class="form-select @error('transactionForm.type') is-invalid @enderror" wire:model.defer="transactionForm.type">
                                        <option value="expense">Expense</option>
                                        <option value="income">Income</option>
                                    </select>
                                    @error('transactionForm.type') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Date</label>
                                    <input type="date" class="form-control @error('transactionForm.date') is-invalid @enderror" wire:model.defer="transactionForm.date">
                                    @error('transactionForm.date') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <select class="form-select @error('transactionForm.category_id') is-invalid @enderror" wire:model.defer="transactionForm.category_id">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('transactionForm.category_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Account</label>
                                    <select class="form-select @error('transactionForm.account_id') is-invalid @enderror" wire:model.defer="transactionForm.account_id">
                                        <option value="">Select Account</option>
                                        @foreach($accounts as $account)
                                            <option value="{{ $account->id }}">{{ $account->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('transactionForm.account_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Notes (Optional)</label>
                            <textarea class="form-control @error('transactionForm.notes') is-invalid @enderror" rows="3" wire:model.defer="transactionForm.notes"></textarea>
                            @error('transactionForm.notes') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancel</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="saveTransaction">
                            <span wire:loading wire:target="saveTransaction" class="spinner-border spinner-border-sm me-2"></span>
                            {{ $editingTransactionId ? 'Update' : 'Add' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style>
        .transactions-container {
            padding: 1.5rem;
        }
        .modal.show.d-block {
            display: block !important;
        }
        .modal-backdrop {
            display: none;
        }
    </style>
</div>
