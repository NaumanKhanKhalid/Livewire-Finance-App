<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Finance Tracker') - Money Manager</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @livewireStyles

    <style>
        :root {
            --primary-color: #3B82F6;
            --secondary-color: #10B981;
            --accent-color: #8B5CF6;
            --warning-color: #F59E0B;
            --danger-color: #EF4444;
            --success-color: #10B981;
            --background-color: #F9FAFB;
            --text-color: #1F2937;
            --border-color: #E5E7EB;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }

        .sidebar {
            background: white;
            border-right: 1px solid var(--border-color);
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            width: 250px;
            transition: all 0.3s ease;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .main-content {
            margin-left: 250px;
            transition: all 0.3s ease;
        }

        .main-content.expanded {
            margin-left: 70px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 4px 12px;
        }

        .sidebar-link:hover {
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
        }

        .sidebar-link.active {
            background-color: var(--primary-color);
            color: white;
        }

        .sidebar-link i {
            width: 20px;
            margin-right: 12px;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #2563EB;
            border-color: #2563EB;
        }

        .stats-card {
            background: linear-gradient(135deg, var(--primary-color), #2563EB);
            color: white;
        }

        .stats-card.income {
            background: linear-gradient(135deg, var(--success-color), #059669);
        }

        .stats-card.expense {
            background: linear-gradient(135deg, var(--danger-color), #DC2626);
        }

        .navbar {
            background: white;
            border-bottom: 1px solid var(--border-color);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }

        .fl-wrapper {
            z-index: 999 !important;
        }

        .fl-flasher {
            z-index: 999 !important;
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="p-3">
            <div class="d-flex align-items-center mb-4">
                <i class="fas fa-wallet text-primary me-2" style="font-size: 1.5rem;"></i>
                <span class="navbar-brand mb-0" id="brand-text">Finance Tracker</span>
            </div>

            <div class="nav flex-column">
                <a wire:navigate href="{{ route('dashboard') }}"
                    class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="nav-text">Dashboard</span>
                </a>

                <a href="{{ route('transactions') }}"
                    class="sidebar-link {{ request()->routeIs('transactions*') ? 'active' : '' }}">
                    <i class="fas fa-exchange-alt"></i>
                    <span class="nav-text">Transactions</span>
                </a>

                <a href="{{ route('budgets') }}"
                    class="sidebar-link {{ request()->routeIs('budgets*') ? 'active' : '' }}">
                    <i class="fas fa-chart-pie"></i>
                    <span class="nav-text">Budgets</span>
                </a>

                <a wire:navigate href="{{ route('reports') }}"
                    class="sidebar-link {{ request()->routeIs('reports*') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar"></i>
                    <span class="nav-text">Reports</span>
                </a>

                <a wire:navigate href="{{ route('accounts') }}"
                    class="sidebar-link {{ request()->routeIs('accounts*') ? 'active' : '' }}">
                    <i class="fas fa-credit-card"></i>
                    <span class="nav-text">Accounts</span>
                </a>

                <a href="{{ route('categories') }}"
                    class="sidebar-link {{ request()->routeIs('categories*') ? 'active' : '' }}">
                    <i class="fas fa-tags"></i>
                    <span class="nav-text">Categories</span>
                </a>

                <a href="{{ route('settings') }}"
                    class="sidebar-link {{ request()->routeIs('settings*') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i>
                    <span class="nav-text">Settings</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <button class="btn btn-link" id="sidebar-toggle">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="ms-auto d-flex align-items-center">
                    <div class="dropdown">
                        <button class="btn btn-link dropdown-toggle text-decoration-none" type="button"
                            id="userDropdown" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-2"></i>
                            <span>{{ auth()->user()->name ?? 'User' }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile') }}"><i
                                        class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('settings') }}"><i
                                        class="fas fa-cog me-2"></i>Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"><i
                                        class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container-fluid p-4">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Sidebar toggle functionality
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const brandText = document.getElementById('brand-text');

            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');

            if (sidebar.classList.contains('collapsed')) {
                brandText.style.display = 'none';
            } else {
                brandText.style.display = 'block';
            }
        });

        // Mobile sidebar toggle
        if (window.innerWidth <= 768) {
            document.getElementById('sidebar-toggle').addEventListener('click', function() {
                const sidebar = document.getElementById('sidebar');
                sidebar.classList.toggle('show');
            });
        }
    </script>
    @livewireScripts

    @stack('scripts')
</body>

</html>
