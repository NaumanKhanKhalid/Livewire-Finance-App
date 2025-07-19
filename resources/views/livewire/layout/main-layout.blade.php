<div>
<div class="app-wrapper">
    <!-- Progress Bar -->
    <div class="progress-bar-container" wire:loading wire:target="navigateTo">
        <div class="progress-bar"></div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar {{ $sidebarOpen ? 'open' : '' }}" id="sidebar">
        <div class="sidebar-header">
            <div class="brand">
                <i class="fas fa-wallet text-primary"></i>
                <span class="brand-text">Finance Tracker</span>
            </div>
            <button class="sidebar-toggle d-lg-none" wire:click="toggleSidebar">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="sidebar-user">
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
            <div class="user-info">
                <h6 class="user-name">{{ $user->name ?? 'User' }}</h6>
                <small class="user-email">{{ $user->email ?? 'user@example.com' }}</small>
            </div>
        </div>

        <nav class="sidebar-nav">
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="#" class="nav-link {{ $currentPage === 'dashboard' ? 'active' : '' }}" 
                       wire:click.prevent="navigateTo('dashboard')">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="#" class="nav-link {{ $currentPage === 'transactions' ? 'active' : '' }}" 
                       wire:click.prevent="navigateTo('transactions')">
                        <i class="fas fa-exchange-alt"></i>
                        <span>Transactions</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="#" class="nav-link {{ $currentPage === 'budgets' ? 'active' : '' }}" 
                       wire:click.prevent="navigateTo('budgets')">
                        <i class="fas fa-chart-pie"></i>
                        <span>Budgets</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="#" class="nav-link {{ $currentPage === 'reports' ? 'active' : '' }}" 
                       wire:click.prevent="navigateTo('reports')">
                        <i class="fas fa-chart-bar"></i>
                        <span>Reports</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="#" class="nav-link {{ $currentPage === 'accounts' ? 'active' : '' }}" 
                       wire:click.prevent="navigateTo('accounts')">
                        <i class="fas fa-credit-card"></i>
                        <span>Accounts</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="#" class="nav-link {{ $currentPage === 'categories' ? 'active' : '' }}" 
                       wire:click.prevent="navigateTo('categories')">
                        <i class="fas fa-tags"></i>
                        <span>Categories</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="#" class="nav-link {{ $currentPage === 'settings' ? 'active' : '' }}" 
                       wire:click.prevent="navigateTo('settings')">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="sidebar-footer">
            <button class="btn btn-outline-danger btn-sm w-100" wire:click="logout">
                <i class="fas fa-sign-out-alt me-2"></i>Logout
            </button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navbar -->
        <nav class="top-navbar">
            <div class="navbar-left">
                <button class="sidebar-toggle d-lg-none" wire:click="toggleSidebar">
                    <i class="fas fa-bars"></i>
                </button>
                <h4 class="page-title">
                    @switch($currentPage)
                        @case('dashboard')
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            @break
                        @case('transactions')
                            <i class="fas fa-exchange-alt me-2"></i>Transactions
                            @break
                        @case('budgets')
                            <i class="fas fa-chart-pie me-2"></i>Budgets
                            @break
                        @case('reports')
                            <i class="fas fa-chart-bar me-2"></i>Reports
                            @break
                        @case('accounts')
                            <i class="fas fa-credit-card me-2"></i>Accounts
                            @break
                        @case('categories')
                            <i class="fas fa-tags me-2"></i>Categories
                            @break
                        @case('settings')
                            <i class="fas fa-cog me-2"></i>Settings
                            @break
                        @default
                            <i class="fas fa-home me-2"></i>Dashboard
                    @endswitch
                </h4>
            </div>
            
            <div class="navbar-right">
                <div class="navbar-actions">
                    <button class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-plus me-2"></i>Add Transaction
                    </button>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#" wire:click.prevent="logout"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="page-content">
            <div class="content-wrapper">
                @switch($currentPage)
                    @case('dashboard')
                        @livewire('pages.dashboard')
                        @break
                    @case('transactions')
                        @livewire('pages.transactions')
                        @break
                    @case('budgets')
                        @livewire('pages.budgets')
                        @break
                    @case('reports')
                        @livewire('pages.reports')
                        @break
                    @case('accounts')
                        @livewire('pages.accounts')
                        @break
                    @case('categories')
                        @livewire('pages.categories')
                        @break
                    @case('settings')
                        @livewire('pages.settings')
                        @break
                    @default
                        @livewire('pages.dashboard')
                @endswitch
            </div>
        </div>
    </div>
</div>

<style>
    .app-wrapper {
        display: flex;
        min-height: 100vh;
        background-color: var(--background-color);
    }

    /* Progress Bar Styles */
    .progress-bar-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: transparent;
        z-index: 9999;
        overflow: hidden;
    }

    .progress-bar {
        height: 100%;
        background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        width: 0%;
        animation: progress-animation 1.5s ease-in-out infinite;
        box-shadow: 0 0 10px rgba(59, 130, 246, 0.5);
    }

    @keyframes progress-animation {
        0% {
            width: 0%;
            opacity: 1;
        }
        50% {
            width: 70%;
            opacity: 0.8;
        }
        100% {
            width: 100%;
            opacity: 0;
        }
    }

    /* Loading overlay for page transitions */
    .page-loading {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        z-index: 9998;
        display: flex;
        justify-content: center;
        align-items: center;
        backdrop-filter: blur(2px);
    }

    .loading-spinner {
        width: 40px;
        height: 40px;
        border: 3px solid #f3f3f3;
        border-top: 3px solid var(--primary-color);
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .sidebar {
        width: 280px;
        background: white;
        border-right: 1px solid #e5e7eb;
        transition: all 0.3s ease;
        position: fixed;
        height: 100vh;
        z-index: 1000;
        overflow-y: auto;
    }

    .sidebar.open {
        transform: translateX(0);
    }

    @media (max-width: 991.98px) {
        .sidebar {
            transform: translateX(-100%);
        }
    }

    .sidebar-header {
        padding: 1.5rem;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .brand {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 700;
        font-size: 1.25rem;
    }

    .brand i {
        font-size: 1.5rem;
    }

    .sidebar-toggle {
        background: none;
        border: none;
        color: #6b7280;
        font-size: 1.25rem;
        cursor: pointer;
    }

    .sidebar-user {
        padding: 1.5rem;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .user-avatar {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
    }

    .user-info {
        flex: 1;
    }

    .user-name {
        margin: 0;
        font-weight: 600;
        color: var(--text-color);
    }

    .user-email {
        color: #6b7280;
        font-size: 0.875rem;
    }

    .sidebar-nav {
        flex: 1;
        padding: 1rem 0;
    }

    .nav-list {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .nav-item {
        margin: 0.25rem 1rem;
    }

    .nav-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        color: #6b7280;
        text-decoration: none;
        border-radius: 0.5rem;
        transition: all 0.2s ease;
        font-weight: 500;
    }

    .nav-link:hover {
        background-color: #f3f4f6;
        color: var(--primary-color);
    }

    .nav-link.active {
        background-color: var(--primary-color);
        color: white;
    }

    .nav-link i {
        width: 20px;
        text-align: center;
    }

    .sidebar-footer {
        padding: 1.5rem;
        border-top: 1px solid #e5e7eb;
    }

    .main-content {
        flex: 1;
        margin-left: 280px;
        transition: all 0.3s ease;
    }

    @media (max-width: 991.98px) {
        .main-content {
            margin-left: 0;
        }
    }

    .top-navbar {
        background: white;
        border-bottom: 1px solid #e5e7eb;
        padding: 1rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 80;
    }

    .navbar-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .page-title {
        margin: 0;
        font-weight: 600;
        color: var(--text-color);
    }

    .navbar-right {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .navbar-actions {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .page-content {
        padding: 1.5rem;
    }

    .content-wrapper {
        background: white;
        border-radius: 0.75rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        min-height: calc(100vh - 200px);
    }

    /* Page transition animations */
    .page-transition {
        transition: opacity 0.3s ease;
    }

    .page-transition.fade-out {
        opacity: 0;
    }

    .page-transition.fade-in {
        opacity: 1;
    }
</style>

<script>
    document.addEventListener('livewire:init', () => {
        // Handle page transitions
        Livewire.on('page-changed', (event) => {
            const content = document.querySelector('.page-transition');
            content.classList.add('fade-out');
            
            setTimeout(() => {
                content.classList.remove('fade-out');
                content.classList.add('fade-in');
            }, 150);
        });

        // Handle loading states
        Livewire.on('loading', () => {
            document.body.style.cursor = 'wait';
        });

        Livewire.on('loaded', () => {
            document.body.style.cursor = 'default';
        });

        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Initialize popovers
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
    });

    // Handle browser back/forward
    window.addEventListener('popstate', (event) => {
        const url = new URL(window.location);
        const page = url.searchParams.get('page') || 'dashboard';
        
        // Trigger Livewire navigation
        Livewire.dispatch('navigateTo', { page: page });
    });

    // Auto-hide alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    });
</script>
</div>
