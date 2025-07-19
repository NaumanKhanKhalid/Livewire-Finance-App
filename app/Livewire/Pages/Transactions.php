<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\Account;
use Flasher\Laravel\Facade\Flasher;

class Transactions extends Component
{
    public $transactions;
    public $categories;
    public $accounts;
    public $showTransactionModal = false;
    public $editingTransactionId = null;
    public $transactionForm = [
        'description' => '',
        'amount' => '',
        'type' => 'expense',
        'category_id' => '',
        'account_id' => '',
        'date' => '',
        'notes' => '',
    ];
    public $successMessage = null;

    protected $rules = [
        'transactionForm.description' => 'required|string|max:255',
        'transactionForm.amount' => 'required|numeric|min:0.01',
        'transactionForm.type' => 'required|in:income,expense',
        'transactionForm.category_id' => 'required|exists:categories,id',
        'transactionForm.account_id' => 'required|exists:accounts,id',
        'transactionForm.date' => 'required|date',
        'transactionForm.notes' => 'nullable|string|max:500',
    ];

    public function mount()
    {
        $this->loadData();
        $this->transactionForm['date'] = now()->format('Y-m-d');
    }

    public function loadData()
    {
        $this->transactions = Transaction::where('user_id', auth()->id())
            ->with(['category', 'account'])
            ->orderBy('date', 'desc')
            ->get();
        $this->categories = Category::where('user_id', auth()->id())->get();
        $this->accounts = Account::where('user_id', auth()->id())->get();
    }

    public function saveTransaction()
    {
        $this->validate();
        
        $data = [
            'user_id' => auth()->id(),
            'description' => $this->transactionForm['description'],
            'amount' => $this->transactionForm['amount'],
            'type' => $this->transactionForm['type'],
            'category_id' => $this->transactionForm['category_id'],
            'account_id' => $this->transactionForm['account_id'],
            'date' => $this->transactionForm['date'],
            'notes' => $this->transactionForm['notes'],
        ];

        if ($this->editingTransactionId) {
            $transaction = Transaction::where('user_id', auth()->id())->findOrFail($this->editingTransactionId);
            $transaction->update($data);
            Flasher::addSuccess('Transaction updated successfully!');
        } else {
            Transaction::create($data);
            Flasher::addSuccess('Transaction added successfully!');
        }
        
        $this->resetForm();
        $this->showTransactionModal = false;
        $this->loadData();
    }

    public function editTransaction($id)
    {
        $transaction = Transaction::where('user_id', auth()->id())->findOrFail($id);
        $this->editingTransactionId = $transaction->id;
        $this->transactionForm = [
            'description' => $transaction->description,
            'amount' => $transaction->amount,
            'type' => $transaction->type,
            'category_id' => $transaction->category_id,
            'account_id' => $transaction->account_id,
            'date' => $transaction->date->format('Y-m-d'),
            'notes' => $transaction->notes,
        ];
        $this->showTransactionModal = true;
    }

    public function deleteTransaction($id)
    {
        $transaction = Transaction::where('user_id', auth()->id())->findOrFail($id);
        $transaction->delete();
        Flasher::addSuccess('Transaction deleted successfully!');
        $this->loadData();
    }

    public function resetForm()
    {
        $this->editingTransactionId = null;
        $this->transactionForm = [
            'description' => '',
            'amount' => '',
            'type' => 'expense',
            'category_id' => '',
            'account_id' => '',
            'date' => now()->format('Y-m-d'),
            'notes' => '',
        ];
    }

    public function closeModal()
    {
        $this->showTransactionModal = false;
        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.pages.transactions');
    }
}
