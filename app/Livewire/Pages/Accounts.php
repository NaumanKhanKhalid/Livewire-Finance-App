<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Account;
use Illuminate\Validation\Rule;
use Flasher\Laravel\Facade\Flasher;

class Accounts extends Component
{
    public $accounts;
    public $showAccountModal = false;
    public $editingAccountId = null;
    public $accountForm = [
        'name' => '',
        'type' => '',
        'balance' => '',
    ];
    public $successMessage = null;

    protected $rules = [
        'accountForm.name' => 'required|string|max:255',
        'accountForm.type' => 'required|in:cash,bank,credit',
        'accountForm.balance' => 'required|numeric',
    ];

    public function mount()
    {
        $this->loadAccounts();
    }

    public function loadAccounts()
    {
        $this->accounts = Account::where('user_id', auth()->id())->get();
    }

    public function saveAccount()
    {
        $this->validate();
        if ($this->editingAccountId) {
            $account = Account::where('user_id', auth()->id())->findOrFail($this->editingAccountId);
            $account->update([
                'name' => $this->accountForm['name'],
                'type' => $this->accountForm['type'],
                'balance' => $this->accountForm['balance'],
            ]);
            Flasher::addSuccess('Account updated successfully!');
        } else {
            Account::create([
                'user_id' => auth()->id(),
                'name' => $this->accountForm['name'],
                'type' => $this->accountForm['type'],
                'balance' => $this->accountForm['balance'],
            ]);
            Flasher::addSuccess('Account added successfully!');
        }
        $this->resetForm();
        $this->showAccountModal = false;
        $this->loadAccounts();
    }

    public function editAccount($id)
    {
        $account = Account::where('user_id', auth()->id())->findOrFail($id);
        $this->editingAccountId = $account->id;
        $this->accountForm = [
            'name' => $account->name,
            'type' => $account->type,
            'balance' => $account->balance,
        ];
        $this->showAccountModal = true;
    }

    public function deleteAccount($id)
    {
        $account = Account::where('user_id', auth()->id())->findOrFail($id);
        $account->delete();
        Flasher::addSuccess('Account deleted successfully!');
        $this->loadAccounts();
    }

    public function resetForm()
    {
        $this->editingAccountId = null;
        $this->accountForm = [
            'name' => '',
            'type' => '',
            'balance' => '',
        ];
    }

    public function closeModal()
    {
        $this->showAccountModal = false;
        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.pages.accounts');
    }
}
