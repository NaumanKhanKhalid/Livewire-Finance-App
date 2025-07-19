<div class="budgets-container">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Budgets</h4>
            <p class="text-muted mb-0">Set spending limits and track progress</p>
        </div>
        <button class="btn btn-primary" wire:click="$set('showBudgetModal', true)">
            <i class="fas fa-plus me-2"></i>Add Budget
        </button>
    </div>

    <!-- Budgets Table -->
    <div class="card mb-4">
        <div class="card-body">
            @if($budgets->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Amount</th>
                                <th>Period</th>
                                <th>Progress</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($budgets as $budget)
                                @php
                                    $progress = 0;
                                    $status = 'active';
                                    $statusClass = 'success';
                                    
                                    if ($budget->start_date <= now() && $budget->end_date >= now()) {
                                        $status = 'active';
                                        $statusClass = 'success';
                                    } elseif ($budget->end_date < now()) {
                                        $status = 'expired';
                                        $statusClass = 'secondary';
                                    } else {
                                        $status = 'upcoming';
                                        $statusClass = 'info';
                                    }
                                @endphp
                                <tr>
                                    <td>
<div>
                                            <strong>{{ $budget->name }}</strong>
                                            @if($budget->description)
                                                <small class="text-muted d-block">{{ $budget->description }}</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if($budget->category)
                                            <span class="badge" style="background-color: {{ $budget->category->color }}; color: #fff;">
                                                <i class="{{ $budget->category->icon }} me-1"></i>
                                                {{ $budget->category->name }}
                                            </span>
                                        @else
                                            <span class="text-muted">No category</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="fw-bold">${{ number_format($budget->amount, 2) }}</span>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $budget->start_date->format('M d') }} - {{ $budget->end_date->format('M d, Y') }}
                                        </small>
                                    </td>
                                    <td>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-{{ $progress > 80 ? 'danger' : ($progress > 60 ? 'warning' : 'success') }}" 
                                                 style="width: {{ min($progress, 100) }}%"></div>
                                        </div>
                                        <small class="text-muted">{{ $progress }}% used</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $statusClass }}">
                                            {{ ucfirst($status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary" wire:click="editBudget({{ $budget->id }})" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-outline-danger" wire:click="deleteBudget({{ $budget->id }})" title="Delete">
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
                    <i class="fas fa-chart-pie fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No budgets found</h5>
                    <p class="text-muted">Start by creating your first budget to track spending limits.</p>
                    <button class="btn btn-primary" wire:click="$set('showBudgetModal', true)">
                        <i class="fas fa-plus me-2"></i>Create Your First Budget
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Add/Edit Budget Modal -->
    <div class="modal fade @if($showBudgetModal) show d-block @endif" tabindex="-1" style="@if($showBudgetModal) display: block; background: rgba(0,0,0,0.5); @else display: none; @endif" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="saveBudget">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $editingBudgetId ? 'Edit Budget' : 'Add Budget' }}</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Budget Name</label>
                                    <input type="text" class="form-control @error('budgetForm.name') is-invalid @enderror" wire:model.defer="budgetForm.name">
                                    @error('budgetForm.name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Amount</label>
                                    <input type="number" step="0.01" class="form-control @error('budgetForm.amount') is-invalid @enderror" wire:model.defer="budgetForm.amount">
                                    @error('budgetForm.amount') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <select class="form-select @error('budgetForm.category_id') is-invalid @enderror" wire:model.defer="budgetForm.category_id">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('budgetForm.category_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Date</label>
                                    <input type="date" class="form-control @error('budgetForm.start_date') is-invalid @enderror" wire:model.defer="budgetForm.start_date">
                                    @error('budgetForm.start_date') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">End Date</label>
                                    <input type="date" class="form-control @error('budgetForm.end_date') is-invalid @enderror" wire:model.defer="budgetForm.end_date">
                                    @error('budgetForm.end_date') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Quick Period</label>
                                    <div class="btn-group w-100" role="group">
                                        <button type="button" class="btn btn-outline-secondary btn-sm" wire:click="$set('budgetForm.start_date', '{{ now()->startOfMonth()->format('Y-m-d') }}'); $set('budgetForm.end_date', '{{ now()->endOfMonth()->format('Y-m-d') }}')">This Month</button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm" wire:click="$set('budgetForm.start_date', '{{ now()->addMonth()->startOfMonth()->format('Y-m-d') }}'); $set('budgetForm.end_date', '{{ now()->addMonth()->endOfMonth()->format('Y-m-d') }}')">Next Month</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description (Optional)</label>
                            <textarea class="form-control @error('budgetForm.description') is-invalid @enderror" rows="3" wire:model.defer="budgetForm.description"></textarea>
                            @error('budgetForm.description') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancel</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="saveBudget">
                            <span wire:loading wire:target="saveBudget" class="spinner-border spinner-border-sm me-2"></span>
                            {{ $editingBudgetId ? 'Update' : 'Add' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style>
        .budgets-container {
            padding: 1.5rem;
        }
        .modal.show.d-block {
            display: block !important;
        }
        .modal-backdrop {
            display: none;
        }
        .progress {
            background-color: #e9ecef;
        }
    </style>
</div>
