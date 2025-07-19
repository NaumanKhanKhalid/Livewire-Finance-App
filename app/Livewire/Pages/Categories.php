<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Category;
use Flasher\Laravel\Facade\Flasher;

class Categories extends Component
{
    public $categories;
    public $showCategoryModal = false;
    public $showIconPicker = false;
    public $iconSearch = '';
    public $showNewGroupInput = false;
    public $newGroupName = '';
    public $editingCategoryId = null;
    public $categoryForm = [
        'name' => '',
        'color' => '',
        'icon' => '',
        'group' => '',
        'monthly_budget' => '',
        'description' => '',
    ];
    public $successMessage = null;
    public $groups = [];
    public $showArchived = false;
    public $showArchiveModal = false;
    public $categoryToArchive = null;

    // Search and Filter Properties
    public $search = '';
    public $selectedGroup = '';
    public $selectedColor = '';
    public $selectedBudgetStatus = '';
    public $sortBy = 'name';
    public $sortDirection = 'asc';

    protected $rules = [
        'categoryForm.name' => 'required|string|max:255',
        'categoryForm.color' => 'required|string|max:20',
        'categoryForm.icon' => 'required|string|max:50',
        'categoryForm.group' => 'nullable|string|max:100',
        'categoryForm.monthly_budget' => 'nullable|numeric|min:0',
        'categoryForm.description' => 'nullable|string|max:500',
    ];

    public function mount()
    {
        $this->loadCategories();
        $this->loadGroups();
    }

    public function loadCategories()
    {
        $query = Category::where('user_id', auth()->id())
            ->withCount('transactions')
            ->with('transactions');

        if (!$this->showArchived) {
            $query->active();
        }

        // Apply search filter
        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('color', 'like', '%' . $this->search . '%')
                  ->orWhere('icon', 'like', '%' . $this->search . '%');
            });
        }

        // Apply group filter
        if (!empty($this->selectedGroup)) {
            $query->where('group', $this->selectedGroup);
        }

        // Apply color filter
        if (!empty($this->selectedColor)) {
            $query->where('color', $this->selectedColor);
        }

        // Apply budget status filter
        if (!empty($this->selectedBudgetStatus)) {
            if ($this->selectedBudgetStatus === 'has_budget') {
                $query->whereNotNull('monthly_budget');
            } elseif ($this->selectedBudgetStatus === 'no_budget') {
                $query->whereNull('monthly_budget');
            } elseif ($this->selectedBudgetStatus === 'over_budget') {
                $query->whereNotNull('monthly_budget')
                      ->whereRaw('(SELECT COALESCE(SUM(amount), 0) FROM transactions WHERE category_id = categories.id AND type = "expense" AND YEAR(date) = ? AND MONTH(date) = ?) > monthly_budget', [now()->year, now()->month]);
            }
        }

        // Apply sorting
        if ($this->sortBy === 'name') {
            $query->orderBy('name', $this->sortDirection);
        } elseif ($this->sortBy === 'group') {
            $query->orderBy('group', $this->sortDirection)->orderBy('name');
        } elseif ($this->sortBy === 'transactions') {
            $query->orderBy('transactions_count', $this->sortDirection);
        } elseif ($this->sortBy === 'budget') {
            $query->orderBy('monthly_budget', $this->sortDirection);
        } else {
            $query->ordered();
        }

        $this->categories = $query->get();
    }

    public function updatedSearch()
    {
        $this->loadCategories();
    }

    public function updatedSelectedGroup()
    {
        $this->loadCategories();
    }

    public function updatedSelectedColor()
    {
        $this->loadCategories();
    }

    public function updatedSelectedBudgetStatus()
    {
        $this->loadCategories();
    }

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
        $this->loadCategories();
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->selectedGroup = '';
        $this->selectedColor = '';
        $this->selectedBudgetStatus = '';
        $this->sortBy = 'name';
        $this->sortDirection = 'asc';
        $this->loadCategories();
    }

    // Bulk Actions Properties
    public $selectedCategories = [];
    public $selectAll = false;
    public $showBulkActions = false;
    public $bulkAction = '';
    public $bulkGroup = '';
    public $showBulkModal = false;

    // Description Modal Properties
    public $showDescriptionModal = false;
    public $selectedCategoryDescription = null;
    public $selectedCategoryName = null;

    public function showFullDescription($id)
    {
        $category = Category::where('user_id', auth()->id())->findOrFail($id);
        $this->selectedCategoryDescription = $category->description;
        $this->selectedCategoryName = $category->name;
        $this->showDescriptionModal = true;
    }

    public function closeDescriptionModal()
    {
        $this->showDescriptionModal = false;
        $this->selectedCategoryDescription = null;
        $this->selectedCategoryName = null;
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedCategories = $this->categories->pluck('id')->toArray();
        } else {
            $this->selectedCategories = [];
        }
        $this->updateBulkActionsVisibility();
    }

    public function updatedSelectedCategories()
    {
        $this->selectAll = count($this->selectedCategories) === $this->categories->count();
        $this->updateBulkActionsVisibility();
    }

    public function updateBulkActionsVisibility()
    {
        $this->showBulkActions = count($this->selectedCategories) > 0;
    }

    public function selectCategory($id)
    {
        if (in_array($id, $this->selectedCategories)) {
            $this->selectedCategories = array_diff($this->selectedCategories, [$id]);
        } else {
            $this->selectedCategories[] = $id;
        }
        $this->updateBulkActionsVisibility();
    }

    public function bulkArchive()
    {
        if (empty($this->selectedCategories)) {
            Flasher::addError('No categories selected!');
            return;
        }

        Category::whereIn('id', $this->selectedCategories)
            ->where('user_id', auth()->id())
            ->update(['is_active' => false]);

        Flasher::addSuccess(count($this->selectedCategories) . ' categories archived successfully!');
        $this->clearBulkSelection();
        $this->loadCategories();
    }

    public function bulkUnarchive()
    {
        if (empty($this->selectedCategories)) {
            Flasher::addError('No categories selected!');
            return;
        }

        Category::whereIn('id', $this->selectedCategories)
            ->where('user_id', auth()->id())
            ->update(['is_active' => true]);

        Flasher::addSuccess(count($this->selectedCategories) . ' categories restored successfully!');
        $this->clearBulkSelection();
        $this->loadCategories();
    }

    public function bulkDelete()
    {
        if (empty($this->selectedCategories)) {
            Flasher::addError('No categories selected!');
            return;
        }

        // Check if any selected categories have transactions
        $categoriesWithTransactions = Category::whereIn('id', $this->selectedCategories)
            ->where('user_id', auth()->id())
            ->whereHas('transactions')
            ->count();

        if ($categoriesWithTransactions > 0) {
            $this->showBulkModal = true;
            return;
        }

        // If no transactions, delete permanently
        Category::whereIn('id', $this->selectedCategories)
            ->where('user_id', auth()->id())
            ->delete();

        Flasher::addSuccess(count($this->selectedCategories) . ' categories deleted successfully!');
        $this->clearBulkSelection();
        $this->loadCategories();
    }

    public function bulkAssignGroup()
    {
        if (empty($this->selectedCategories) || empty($this->bulkGroup)) {
            Flasher::addError('Please select categories and specify a group!');
            return;
        }

        Category::whereIn('id', $this->selectedCategories)
            ->where('user_id', auth()->id())
            ->update(['group' => $this->bulkGroup]);

        Flasher::addSuccess(count($this->selectedCategories) . ' categories assigned to group "' . $this->bulkGroup . '" successfully!');
        $this->clearBulkSelection();
        $this->loadCategories();
        $this->loadGroups();
    }

    public function confirmBulkDelete()
    {
        // Archive categories with transactions instead of deleting
        Category::whereIn('id', $this->selectedCategories)
            ->where('user_id', auth()->id())
            ->update(['is_active' => false]);

        Flasher::addSuccess(count($this->selectedCategories) . ' categories archived successfully! (Transactions preserved)');
        $this->showBulkModal = false;
        $this->clearBulkSelection();
        $this->loadCategories();
    }

    public function cancelBulkDelete()
    {
        $this->showBulkModal = false;
    }

    public function clearBulkSelection()
    {
        $this->selectedCategories = [];
        $this->selectAll = false;
        $this->showBulkActions = false;
        $this->bulkAction = '';
        $this->bulkGroup = '';
    }

    public function loadGroups()
    {
        $this->groups = Category::where('user_id', auth()->id())
            ->whereNotNull('group')
            ->distinct()
            ->pluck('group')
            ->filter()
            ->values()
            ->toArray();
    }

    public function saveCategory()
    {
        $this->validate();
        if ($this->editingCategoryId) {
            $category = Category::where('user_id', auth()->id())->findOrFail($this->editingCategoryId);
            $category->update([
                'name' => $this->categoryForm['name'],
                'color' => $this->categoryForm['color'],
                'icon' => $this->categoryForm['icon'],
                'group' => $this->categoryForm['group'],
                'monthly_budget' => $this->categoryForm['monthly_budget'] ?: null,
                'description' => $this->categoryForm['description'] ?: null,
            ]);
            Flasher::addSuccess('Category updated successfully!');
        } else {
            Category::create([
                'user_id' => auth()->id(),
                'name' => $this->categoryForm['name'],
                'color' => $this->categoryForm['color'],
                'icon' => $this->categoryForm['icon'],
                'group' => $this->categoryForm['group'],
                'monthly_budget' => $this->categoryForm['monthly_budget'] ?: null,
                'description' => $this->categoryForm['description'] ?: null,
            ]);
            Flasher::addSuccess('Category added successfully!');
        }
        $this->resetForm();
        $this->showCategoryModal = false;
        $this->loadCategories();
        $this->loadGroups();
    }

    public function editCategory($id)
    {
        $category = Category::where('user_id', auth()->id())->findOrFail($id);
        $this->editingCategoryId = $category->id;
        $this->categoryForm = [
            'name' => $category->name,
            'color' => $category->color,
            'icon' => $category->icon,
            'group' => $category->group,
            'monthly_budget' => $category->monthly_budget,
            'description' => $category->description,
        ];
        $this->showCategoryModal = true;
    }

    public function toggleArchived()
    {
        $this->showArchived = !$this->showArchived;
        $this->loadCategories();
    }

    public function archiveCategory($id)
    {
        $category = Category::where('user_id', auth()->id())->findOrFail($id);
        $category->update(['is_active' => false]);
        Flasher::addSuccess('Category archived successfully!');
        $this->loadCategories();
    }

    public function unarchiveCategory($id)
    {
        $category = Category::where('user_id', auth()->id())->findOrFail($id);
        $category->update(['is_active' => true]);
        Flasher::addSuccess('Category restored successfully!');
        $this->loadCategories();
    }

    public function deleteCategory($id)
    {
        $category = Category::where('user_id', auth()->id())->findOrFail($id);
        
        // Check if category has transactions
        if ($category->transactions()->count() > 0) {
            $this->categoryToArchive = $category;
            $this->showArchiveModal = true;
            return;
        }
        
        // If no transactions, delete permanently
        $category->delete();
        Flasher::addSuccess('Category deleted successfully!');
        $this->loadCategories();
    }

    public function confirmArchive()
    {
        if ($this->categoryToArchive) {
            $this->categoryToArchive->update(['is_active' => false]);
            Flasher::addSuccess('Category archived successfully! (Transactions preserved)');
            $this->showArchiveModal = false;
            $this->categoryToArchive = null;
            $this->loadCategories();
        }
    }

    public function cancelArchive()
    {
        $this->showArchiveModal = false;
        $this->categoryToArchive = null;
    }

    public function addNewGroup()
    {
        if (!empty($this->newGroupName)) {
            $this->categoryForm['group'] = $this->newGroupName;
            $this->newGroupName = '';
            $this->showNewGroupInput = false;
            $this->loadGroups();
        }
    }

    public function resetForm()
    {
        $this->editingCategoryId = null;
        $this->categoryForm = [
            'name' => '',
            'color' => '',
            'icon' => '',
            'group' => '',
            'monthly_budget' => '',
            'description' => '',
        ];
        $this->showNewGroupInput = false;
        $this->newGroupName = '';
    }

    public function closeModal()
    {
        $this->showCategoryModal = false;
        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.pages.categories');
    }
}
