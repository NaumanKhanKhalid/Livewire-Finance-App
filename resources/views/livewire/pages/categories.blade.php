<div class="categories-container">
    <!-- Header with Actions -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Categories</h2>
            <p class="text-muted mb-0">Manage your expense and income categories</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary" wire:click="toggleArchived">
                <i class="fas fa-{{ $showArchived ? 'eye-slash' : 'archive' }}"></i>
                {{ $showArchived ? 'Hide Archived' : 'Show Archived' }}
            </button>
            <button class="btn btn-primary" wire:click="$set('showCategoryModal', true)">
                <i class="fas fa-plus"></i> Add Category
            </button>
        </div>
    </div>

    <!-- Category Summary Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title text-muted mb-1">Total Categories</h6>
                            <h3 class="mb-0">{{ $categories->count() }}</h3>
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
                            <h6 class="card-title text-muted mb-1">Total Budget</h6>
                            <h3 class="mb-0">${{ number_format($categories->whereNotNull('monthly_budget')->sum('monthly_budget'), 2) }}</h3>
                            <small class="text-muted">{{ $categories->whereNotNull('monthly_budget')->count() }} categories</small>
                        </div>
                        <div class="text-success">
                            <i class="fas fa-dollar-sign fa-2x"></i>
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
                            <h6 class="card-title text-muted mb-1">Budget Used</h6>
                            <h3 class="mb-0">${{ number_format($categories->sum('current_month_spent'), 2) }}</h3>
                            <small class="text-{{ $categories->sum('current_month_spent') > $categories->whereNotNull('monthly_budget')->sum('monthly_budget') * 0.8 ? 'danger' : 'success' }}">
                                {{ $categories->whereNotNull('monthly_budget')->count() > 0 ? number_format(($categories->sum('current_month_spent') / $categories->whereNotNull('monthly_budget')->sum('monthly_budget')) * 100, 1) : 0 }}% used
                            </small>
                        </div>
                        <div class="text-warning">
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
                            <h6 class="card-title text-muted mb-1">Groups</h6>
                            <h3 class="mb-0">{{ count($groups) }}</h3>
                        </div>
                        <div class="text-info">
                            <i class="fas fa-layer-group fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="card mb-4 filter-card">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Search Categories</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" wire:model.live.debounce.300ms="search" placeholder="Search by name, color, or icon...">
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Group</label>
                    <select class="form-select" wire:model.live="selectedGroup">
                        <option value="">All Groups</option>
                        @foreach($groups as $group)
                            <option value="{{ $group }}">{{ $group }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Color</label>
                    <select class="form-select" wire:model.live="selectedColor">
                        <option value="">All Colors</option>
                        @foreach($categories->pluck('color')->unique() as $color)
                            <option value="{{ $color }}">{{ $color }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Budget Status</label>
                    <select class="form-select" wire:model.live="selectedBudgetStatus">
                        <option value="">All Categories</option>
                        <option value="has_budget">Has Budget</option>
                        <option value="no_budget">No Budget</option>
                        <option value="over_budget">Over Budget</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Sort By</label>
                    <select class="form-select" wire:model.live="sortBy">
                        <option value="name">Name</option>
                        <option value="group">Group</option>
                        <option value="transactions">Transactions</option>
                        <option value="budget">Budget</option>
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <button class="btn btn-outline-secondary btn-sm" wire:click="clearFilters">
                        <i class="fas fa-times"></i> Clear Filters
                    </button>
                    @if($search || $selectedGroup || $selectedColor || $selectedBudgetStatus)
                        <span class="badge bg-info ms-2">{{ $categories->count() }} results</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Bulk Actions -->
    @if($showBulkActions)
    <div class="card mb-3 border-warning">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <strong class="text-warning">
                        <i class="fas fa-check-square"></i> 
                        {{ count($selectedCategories) }} category(ies) selected
                    </strong>
                </div>
                <div class="col-md-3">
                    <select class="form-select" wire:model="bulkAction">
                        <option value="">Choose Action...</option>
                        @if($showArchived)
                            <option value="unarchive">Restore Selected</option>
                        @else
                            <option value="archive">Archive Selected</option>
                        @endif
                        <option value="delete">Delete Selected</option>
                        <option value="assign_group">Assign to Group</option>
                    </select>
                </div>
                <div class="col-md-3">
                    @if($bulkAction === 'assign_group')
                        <div class="input-group">
                            <input type="text" class="form-control" wire:model="bulkGroup" placeholder="Enter group name">
                            <button class="btn btn-primary" wire:click="bulkAssignGroup">
                                <i class="fas fa-save"></i> Assign
                            </button>
                        </div>
                    @endif
                </div>
                <div class="col-md-3 text-end">
                    <button class="btn btn-outline-secondary btn-sm" wire:click="clearBulkSelection">
                        <i class="fas fa-times"></i> Clear Selection
                    </button>
                </div>
            </div>
            @if($bulkAction && $bulkAction !== 'assign_group')
            <div class="row mt-2">
                <div class="col-12">
                    <button class="btn btn-{{ $bulkAction === 'archive' ? 'warning' : ($bulkAction === 'unarchive' ? 'success' : 'danger') }}" 
                            wire:click="bulk{{ ucfirst($bulkAction) }}">
                        <i class="fas fa-{{ $bulkAction === 'archive' ? 'archive' : ($bulkAction === 'unarchive' ? 'undo' : 'trash') }}"></i>
                        {{ ucfirst($bulkAction) }} Selected
                    </button>
                </div>
            </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Categories Table -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">All Categories</h5>
            <button class="btn btn-outline-secondary btn-sm" wire:click="$set('showReorderMode', true)" wire:loading.attr="disabled">
                <i class="fas fa-sort"></i> Reorder
            </button>
        </div>
        <div class="card-body">
            @if($categories->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 50px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" wire:model="selectAll">
                                    </div>
                                </th>
                                <th class="sortable-header" style="cursor: pointer;" wire:click="sortBy('name')">
                                    Name
                                    @if($sortBy === 'name')
                                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                    @else
                                        <i class="fas fa-sort text-muted ms-1"></i>
                                    @endif
                                </th>
                                <th class="sortable-header" style="cursor: pointer;" wire:click="sortBy('group')">
                                    Group
                                    @if($sortBy === 'group')
                                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                    @else
                                        <i class="fas fa-sort text-muted ms-1"></i>
                                    @endif
                                </th>
                                <th>Color</th>
                                <th>Icon</th>
                                <th class="sortable-header" style="cursor: pointer;" wire:click="sortBy('transactions')">
                                    Transactions
                                    @if($sortBy === 'transactions')
                                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                    @else
                                        <i class="fas fa-sort text-muted ms-1"></i>
                                    @endif
                                </th>
                                <th class="sortable-header" style="cursor: pointer;" wire:click="sortBy('budget')">
                                    Budget
                                    @if($sortBy === 'budget')
                                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                    @else
                                        <i class="fas fa-sort text-muted ms-1"></i>
                                    @endif
                                </th>
                                <th>Description</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="sortable-categories">
                            @foreach($categories->groupBy('group') as $groupName => $groupCategories)
                                @if($groupName)
                                    <tr class="table-light">
                                        <td colspan="10">
                                            <strong>{{ $groupName }}</strong>
                                            <span class="badge bg-secondary ms-2">{{ $groupCategories->count() }} categories</span>
                                            <span class="badge bg-info ms-2">{{ $groupCategories->sum('transactions_count') }} transactions</span>
                                        </td>
                                    </tr>
                                @endif
                                @foreach($groupCategories as $category)
                                    <tr data-category-id="{{ $category->id }}" class="sortable-row {{ !$category->is_active ? 'table-secondary opacity-75' : '' }}">
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" 
                                                       wire:model="selectedCategories" 
                                                       value="{{ $category->id }}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="category-icon bg-light text-dark rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; background: {{ $category->color }};">
                                                    <i class="{{ $category->icon }}"></i>
                                                </div>
<div>
                                                    <h6 class="mb-0">
                                                        {{ $category->name }}
                                                        @if(!$category->is_active)
                                                            <span class="badge bg-secondary ms-2">Archived</span>
                                                        @endif
                                                    </h6>
                                                    <small class="text-muted">{{ $category->color }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($category->group)
                                                <span class="badge bg-light text-dark">{{ $category->group }}</span>
                                            @else
                                                <span class="text-muted">No group</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge" style="background-color: {{ $category->color }}; color: #fff;">
                                                {{ $category->color }}
                                            </span>
                                        </td>
                                        <td>
                                            <i class="{{ $category->icon }}"></i>
                                            <span class="ms-2">{{ $category->icon }}</span>
                                        </td>
                                        <td>
                                            {{ $category->transactions_count ?? 0 }}
                                        </td>
                                        <td>
                                            @if($category->monthly_budget)
                                                <div class="budget-info">
                                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                                        <small class="text-muted">${{ number_format($category->current_month_spent, 2) }}</small>
                                                        <small class="text-muted">${{ number_format($category->monthly_budget, 2) }}</small>
                                                    </div>
                                                    <div class="progress" style="height: 6px;">
                                                        <div class="progress-bar bg-{{ $category->budget_progress > 80 ? 'danger' : ($category->budget_progress > 60 ? 'warning' : 'success') }}" 
                                                             style="width: {{ $category->budget_progress }}%"></div>
                                                    </div>
                                                    <small class="text-muted">{{ number_format($category->budget_progress, 1) }}%</small>
                                                </div>
                                            @else
                                                <span class="text-muted">No budget</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($category->description)
                                                <div class="description-cell" style="max-width: 200px; cursor: pointer;" wire:click="showFullDescription({{ $category->id }})">
                                                    <div class="text-truncate" title="{{ $category->description }}">
                                                        {{ Str::limit($category->description, 50) }}
                                                    </div>
                                                    @if(strlen($category->description) > 50)
                                                        <small class="text-muted">Click to view full description</small>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-muted">No description</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-outline-primary" wire:click="editCategory({{ $category->id }})" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                @if($category->is_active)
                                                    <button class="btn btn-outline-warning" wire:click="archiveCategory({{ $category->id }})" title="Archive">
                                                        <i class="fas fa-archive"></i>
                                                    </button>
                                                @else
                                                    <button class="btn btn-outline-success" wire:click="unarchiveCategory({{ $category->id }})" title="Restore">
                                                        <i class="fas fa-undo"></i>
                                                    </button>
                                                @endif
                                                <button class="btn btn-outline-danger" wire:click="deleteCategory({{ $category->id }})" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No categories found</h5>
                    <p class="text-muted">Start by adding your first category.</p>
                    <button class="btn btn-primary" wire:click="$set('showCategoryModal', true)">
                        <i class="fas fa-plus me-2"></i>Add Your First Category
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Add/Edit Category Modal -->
    <div class="modal fade @if($showCategoryModal) show d-block @endif" tabindex="-1" style="@if($showCategoryModal) display: block; background: rgba(0,0,0,0.5); @else display: none; @endif" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit.prevent="saveCategory">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $editingCategoryId ? 'Edit Category' : 'Add Category' }}</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
                            <input type="text" class="form-control @error('categoryForm.name') is-invalid @enderror" wire:model.defer="categoryForm.name">
                            @error('categoryForm.name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Group (Optional)</label>
                            <div class="d-flex gap-2">
                                <select class="form-select" wire:model.defer="categoryForm.group">
                                    <option value="">No Group</option>
                                    @foreach($groups as $group)
                                        <option value="{{ $group }}">{{ $group }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-outline-secondary" wire:click="$set('showNewGroupInput', true)">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            @if($showNewGroupInput)
                                <div class="mt-2">
                                    <input type="text" class="form-control" placeholder="Enter new group name" wire:model.defer="newGroupName">
                                    <div class="mt-1">
                                        <button type="button" class="btn btn-sm btn-primary" wire:click="addNewGroup">Add Group</button>
                                        <button type="button" class="btn btn-sm btn-secondary" wire:click="$set('showNewGroupInput', false)">Cancel</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Monthly Budget (Optional)</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" class="form-control @error('categoryForm.monthly_budget') is-invalid @enderror" wire:model.defer="categoryForm.monthly_budget" placeholder="0.00">
                            </div>
                            <small class="form-text text-muted">Set a monthly spending limit for this category</small>
                            @error('categoryForm.monthly_budget') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description (Optional)</label>
                            <textarea class="form-control @error('categoryForm.description') is-invalid @enderror" 
                                      wire:model.defer="categoryForm.description" 
                                      rows="3" 
                                      placeholder="Add a description or note about this category..."></textarea>
                            <small class="form-text text-muted">Helpful notes about when to use this category</small>
                            @error('categoryForm.description') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Color</label>
                            <div class="d-flex align-items-center gap-3">
                                <input type="color" class="form-control form-control-color @error('categoryForm.color') is-invalid @enderror" wire:model.defer="categoryForm.color" style="width: 60px; height: 40px;">
                                <div class="color-preview rounded border" style="width: 40px; height: 40px; background-color: {{ $categoryForm['color'] ?? '#007bff' }};"></div>
                            </div>
                            @error('categoryForm.color') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Suggested Colors</label>
                            <div class="suggested-colors d-flex flex-wrap gap-2">
                                @php
                                    $suggestedColors = [
                                        '#007bff', '#28a745', '#dc3545', '#ffc107', '#17a2b8',
                                        '#6f42c1', '#fd7e14', '#e83e8c', '#20c997', '#6c757d',
                                        '#343a40', '#f8f9fa', '#dee2e6', '#adb5bd', '#495057'
                                    ];
                                @endphp
                                @foreach($suggestedColors as $color)
                                    <button type="button" class="btn btn-sm rounded-circle" style="width: 30px; height: 30px; background-color: {{ $color }}; border: 2px solid #dee2e6;" wire:click="$set('categoryForm.color', '{{ $color }}')" title="{{ $color }}"></button>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Icon</label>
                            <div class="d-flex align-items-center gap-3 mb-2">
                                <input type="text" class="form-control @error('categoryForm.icon') is-invalid @enderror" wire:model.defer="categoryForm.icon" placeholder="e.g. fas fa-utensils" readonly>
                                <button type="button" class="btn btn-outline-secondary" wire:click="$set('showIconPicker', true)">
                                    <i class="fas fa-icons"></i> Pick Icon
                                </button>
                                @if($categoryForm['icon'])
                                    <div class="icon-preview d-flex align-items-center justify-content-center rounded border" style="width: 40px; height: 40px; background-color: #f8f9fa;">
                                        <i class="{{ $categoryForm['icon'] }}" style="font-size: 1.2rem;"></i>
                                    </div>
                                @endif
                            </div>
                            @error('categoryForm.icon') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <!-- Icon Picker Modal -->
                        <div class="modal fade @if($showIconPicker) show d-block @endif" tabindex="-1" style="@if($showIconPicker) display: block; background: rgba(0,0,0,0.5); @else display: none; @endif" aria-modal="true" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Select Icon</h5>
                                        <button type="button" class="btn-close" wire:click="$set('showIconPicker', false)"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="Search icons..." wire:model.debounce.300ms="iconSearch">
                                        </div>
                                        <div class="icon-categories">
                                            @php
                                                $iconCategories = [
                                                    'Common' => [
                                                        'fas fa-home', 'fas fa-user', 'fas fa-cog', 'fas fa-star', 'fas fa-heart',
                                                        'fas fa-check', 'fas fa-times', 'fas fa-plus', 'fas fa-minus', 'fas fa-search'
                                                    ],
                                                    'Food & Dining' => [
                                                        'fas fa-utensils', 'fas fa-pizza-slice', 'fas fa-hamburger', 'fas fa-coffee',
                                                        'fas fa-wine-glass', 'fas fa-ice-cream', 'fas fa-apple-alt', 'fas fa-carrot'
                                                    ],
                                                    'Transport' => [
                                                        'fas fa-car', 'fas fa-bus', 'fas fa-train', 'fas fa-plane', 'fas fa-bicycle',
                                                        'fas fa-motorcycle', 'fas fa-ship', 'fas fa-taxi'
                                                    ],
                                                    'Shopping' => [
                                                        'fas fa-shopping-cart', 'fas fa-shopping-bag', 'fas fa-store', 'fas fa-tags',
                                                        'fas fa-gift', 'fas fa-credit-card', 'fas fa-wallet', 'fas fa-money-bill'
                                                    ],
                                                    'Entertainment' => [
                                                        'fas fa-gamepad', 'fas fa-tv', 'fas fa-music', 'fas fa-film', 'fas fa-book',
                                                        'fas fa-theater-masks', 'fas fa-dumbbell', 'fas fa-running'
                                                    ],
                                                    'Health' => [
                                                        'fas fa-heartbeat', 'fas fa-pills', 'fas fa-stethoscope', 'fas fa-hospital',
                                                        'fas fa-user-md', 'fas fa-ambulance', 'fas fa-first-aid', 'fas fa-smile'
                                                    ],
                                                    'Education' => [
                                                        'fas fa-graduation-cap', 'fas fa-book-open', 'fas fa-chalkboard-teacher',
                                                        'fas fa-university', 'fas fa-pencil-alt', 'fas fa-calculator', 'fas fa-microscope'
                                                    ],
                                                    'Business' => [
                                                        'fas fa-briefcase', 'fas fa-building', 'fas fa-chart-line', 'fas fa-chart-bar',
                                                        'fas fa-file-invoice', 'fas fa-handshake', 'fas fa-users', 'fas fa-phone'
                                                    ]
                                                ];
                                            @endphp
                                            @foreach($iconCategories as $category => $icons)
                                                <div class="mb-4">
                                                    <h6 class="text-muted mb-2">{{ $category }}</h6>
                                                    <div class="d-flex flex-wrap gap-2">
                                                        @foreach($icons as $icon)
                                                            @if(empty($iconSearch) || str_contains(strtolower($icon), strtolower($iconSearch)))
                                                                <button type="button" class="btn btn-outline-secondary btn-sm d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;" wire:click="$set('categoryForm.icon', '{{ $icon }}'); $set('showIconPicker', false)" title="{{ $icon }}">
                                                                    <i class="{{ $icon }}"></i>
                                                                </button>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" wire:click="$set('showIconPicker', false)">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancel</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="saveCategory">
                            <span wire:loading wire:target="saveCategory" class="spinner-border spinner-border-sm me-2"></span>
                            {{ $editingCategoryId ? 'Update' : 'Add' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Archive Confirmation Modal -->
    @if($showArchiveModal && $categoryToArchive)
    <div class="modal fade show" style="display: block;" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Archive Category</h5>
                    <button type="button" class="btn-close" wire:click="cancelArchive"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to archive <strong>{{ $categoryToArchive->name }}</strong>?</p>
                    <p class="text-muted">
                        This category has {{ $categoryToArchive->transactions()->count() }} transactions. 
                        Archiving will preserve all transaction history but hide the category from active use.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="cancelArchive">Cancel</button>
                    <button type="button" class="btn btn-warning" wire:click="confirmArchive">
                        <i class="fas fa-archive"></i> Archive Category
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif

    <!-- Bulk Delete Confirmation Modal -->
    @if($showBulkModal)
    <div class="modal fade show" style="display: block;" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bulk Delete Categories</h5>
                    <button type="button" class="btn-close" wire:click="cancelBulkDelete"></button>
                </div>
                <div class="modal-body">
                    <p>Some of the selected categories have transactions associated with them.</p>
                    <p class="text-muted">
                        To preserve transaction history, these categories will be archived instead of deleted.
                        You can restore them later if needed.
                    </p>
                    <p><strong>Are you sure you want to proceed?</strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="cancelBulkDelete">Cancel</button>
                    <button type="button" class="btn btn-warning" wire:click="confirmBulkDelete">
                        <i class="fas fa-archive"></i> Archive Categories
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif

    <!-- Description Modal -->
    @if($showDescriptionModal)
    <div class="modal fade show" style="display: block;" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Description - {{ $selectedCategoryName }}</h5>
                    <button type="button" class="btn-close" wire:click="closeDescriptionModal"></button>
                </div>
                <div class="modal-body">
                    <div class="description-content">
                        {{ $selectedCategoryDescription }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeDescriptionModal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif

    <style>
        .categories-container {
            padding: 1.5rem;
        }
        .modal.show.d-block {
            display: block !important;
        }
        .modal-backdrop {
            display: none;
        }
        .category-icon {
            min-width: 40px;
        }
        .sortable-row.sortable-ghost {
            opacity: 0.5;
            background-color: #f8f9fa;
        }
        .sortable-row.sortable-chosen {
            background-color: #e3f2fd;
        }
        .sortable-header:hover {
            background-color: rgba(0,0,0,0.05);
        }
        .filter-card {
            border-left: 4px solid #007bff;
        }
        .search-highlight {
            background-color: #fff3cd;
            padding: 2px 4px;
            border-radius: 3px;
        }
        .description-cell {
            transition: background-color 0.2s ease;
        }
        .description-cell:hover {
            background-color: rgba(0,123,255,0.1);
            border-radius: 4px;
            padding: 4px;
            margin: -4px;
        }
        .description-content {
            white-space: pre-wrap;
            line-height: 1.6;
            color: #495057;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            initSortable();
        });

        document.addEventListener('livewire:updated', function () {
            initSortable();
        });

        function initSortable() {
            const tbody = document.getElementById('sortable-categories');
            if (tbody) {
                new Sortable(tbody, {
                    handle: '.drag-handle',
                    animation: 150,
                    ghostClass: 'sortable-ghost',
                    chosenClass: 'sortable-chosen',
                    onEnd: function (evt) {
                        const categoryIds = Array.from(tbody.querySelectorAll('.sortable-row'))
                            .map(row => row.dataset.categoryId);
                        
                        @this.call('updateCategoryOrder', categoryIds);
                    }
                });
            }
        }
    </script>
</div>
