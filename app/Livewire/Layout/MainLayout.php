<?php

namespace App\Livewire\Layout;

use Livewire\Component;

class MainLayout extends Component
{
    public $currentPage = 'dashboard';
    public $sidebarOpen = true;
    public $user;

    protected $listeners = ['navigateTo'];

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function navigateTo($page)
    {
        $this->currentPage = $page;
        $this->dispatch('page-changed', page: $page);
    }

    public function toggleSidebar()
    {
        $this->sidebarOpen = !$this->sidebarOpen;
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.layout.main-layout');
    }
}
