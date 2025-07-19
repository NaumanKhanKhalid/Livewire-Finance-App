<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Tracker - Dashboard</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
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
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            margin: 0;
            padding: 0;
        }

        /* Loading spinner */
        .loading-spinner {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: var(--background-color);
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Livewire loading states */
        [wire\:loading] {
            opacity: 0.6;
            pointer-events: none;
        }

        [wire\:loading\.delay] {
            opacity: 0.6;
            pointer-events: none;
        }

        /* Livewire loading spinner */
        [wire\:loading] .loading-spinner {
            display: flex;
        }

        [wire\:loading\.delay] .loading-spinner {
            display: flex;
        }

        /* Page transitions */
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

    @livewireStyles
</head>
<body>
    <!-- Loading Spinner -->
    <div class="loading-spinner" wire:loading>
        <div class="spinner"></div>
    </div>

    <!-- Main Application -->
    <div class="page-transition">
        @livewire('layout.main-layout')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @livewireScripts

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
</body>
</html> 