<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Budget;
use App\Models\Category;
use Flasher\Laravel\Facade\Flasher;

class Budgets extends Component
{
    public $budgets;
    public $categories;
    public $showBudgetModal = false;
    public $editingBudgetId = null;
    public $budgetForm = [
        'name' => '',
        'amount' => '',
        'category_id' => '',
        'start_date' => '',
        'end_date' => '',
        'description' => '',
    ];
    public $successMessage = null;

    protected $rules = [
        'budgetForm.name' => 'required|string|max:255',
        'budgetForm.amount' => 'required|numeric|min:0.01',
        'budgetForm.category_id' => 'required|exists:categories,id',
        'budgetForm.start_date' => 'required|date',
        'budgetForm.end_date' => 'required|date|after:budgetForm.start_date',
        'budgetForm.description' => 'nullable|string|max:500',
    ];

    public function mount()
    {
        $this->loadData();
        $this->budgetForm['start_date'] = now()->startOfMonth()->format('Y-m-d');
        $this->budgetForm['end_date'] = now()->endOfMonth()->format('Y-m-d');
    }

    public function loadData()
    {
        $this->budgets = Budget::where('user_id', auth()->id())
            ->with(['category'])
            ->orderBy('start_date', 'desc')
            ->get();
        $this->categories = Category::where('user_id', auth()->id())->get();
    }

    public function saveBudget()
    {
        $this->validate();
        
        $data = [
            'user_id' => auth()->id(),
            'name' => $this->budgetForm['name'],
            'amount' => $this->budgetForm['amount'],
            'category_id' => $this->budgetForm['category_id'],
            'start_date' => $this->budgetForm['start_date'],
            'end_date' => $this->budgetForm['end_date'],
            'description' => $this->budgetForm['description'],
        ];

        if ($this->editingBudgetId) {
            $budget = Budget::where('user_id', auth()->id())->findOrFail($this->editingBudgetId);
            $budget->update($data);
            Flasher::addSuccess('Budget updated successfully!');
        } else {
            Budget::create($data);
            Flasher::addSuccess('Budget added successfully!');
        }
        
        $this->resetForm();
        $this->showBudgetModal = false;
        $this->loadData();
    }

    public function editBudget($id)
    {
        $budget = Budget::where('user_id', auth()->id())->findOrFail($id);
        $this->editingBudgetId = $budget->id;
        $this->budgetForm = [
            'name' => $budget->name,
            'amount' => $budget->amount,
            'category_id' => $budget->category_id,
            'start_date' => $budget->start_date->format('Y-m-d'),
            'end_date' => $budget->end_date->format('Y-m-d'),
            'description' => $budget->description,
        ];
        $this->showBudgetModal = true;
    }

    public function deleteBudget($id)
    {
        $budget = Budget::where('user_id', auth()->id())->findOrFail($id);
        $budget->delete();
        Flasher::addSuccess('Budget deleted successfully!');
        $this->loadData();
    }

    public function resetForm()
    {
        $this->editingBudgetId = null;
        $this->budgetForm = [
            'name' => '',
            'amount' => '',
            'category_id' => '',
            'start_date' => now()->startOfMonth()->format('Y-m-d'),
            'end_date' => now()->endOfMonth()->format('Y-m-d'),
            'description' => '',
        ];
    }

    public function closeModal()
    {
        $this->showBudgetModal = false;
        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.pages.budgets');
    }
}
