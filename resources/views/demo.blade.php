<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Tracker - Demo</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
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
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: white;
            padding: 80px 0;
        }

        .feature-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
        }

        .stats-card {
            background: linear-gradient(135deg, var(--primary-color), #2563EB);
            color: white;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
        }

        .stats-card.income {
            background: linear-gradient(135deg, var(--success-color), #059669);
        }

        .stats-card.expense {
            background: linear-gradient(135deg, var(--danger-color), #DC2626);
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .demo-preview {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .demo-header {
            background: var(--primary-color);
            color: white;
            padding: 20px;
            text-align: center;
        }

        .demo-content {
            padding: 30px;
        }

        .pricing-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .pricing-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .pricing-card.featured {
            border: 2px solid var(--primary-color);
            transform: scale(1.05);
        }

        .pricing-card.featured::before {
            content: "Most Popular";
            position: absolute;
            top: 20px;
            right: -30px;
            background: var(--primary-color);
            color: white;
            padding: 5px 40px;
            transform: rotate(45deg);
            font-size: 12px;
            font-weight: 600;
        }

        .testimonial-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .testimonial-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 32px;
            margin: 0 auto 20px;
        }

        .scroll-indicator {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateX(-50%) translateY(0);
            }
            40% {
                transform: translateX(-50%) translateY(-10px);
            }
            60% {
                transform: translateX(-50%) translateY(-5px);
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-wallet text-primary me-2"></i>
                Finance Tracker
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="#features">Features</a>
                <a class="nav-link" href="#pricing">Pricing</a>
                <a class="nav-link" href="#testimonials">Reviews</a>
                <a class="nav-link" href="#demo">Demo</a>
                <a class="nav-link" href="{{ route('login') }}">Login</a>
                <a class="btn btn-primary ms-2" href="{{ route('register') }}">Get Started</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section position-relative">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">
                        Take Control of Your Finances
                    </h1>
                    <p class="lead mb-4">
                        Track expenses, set budgets, and achieve your financial goals with our comprehensive finance management system.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg">
                            <i class="fas fa-rocket me-2"></i>Start Free Trial
                        </a>
                        <a href="#demo" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-play me-2"></i>Watch Demo
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="demo-preview">
                        <div class="demo-header">
                            <h5 class="mb-0">Dashboard Preview</h5>
                        </div>
                        <div class="demo-content">
                            <div class="row mb-4">
                                <div class="col-6">
                                    <div class="stats-card income">
                                        <h4>$8,500</h4>
                                        <small>Monthly Income</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="stats-card expense">
                                        <h4>$6,400</h4>
                                        <small>Monthly Expenses</small>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mb-3" style="height: 10px;">
                                <div class="progress-bar bg-success" style="width: 75%"></div>
                            </div>
                            <small class="text-muted">Budget Progress: 75%</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="scroll-indicator">
            <i class="fas fa-chevron-down text-white fa-2x"></i>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">Powerful Features</h2>
                <p class="lead text-muted">Everything you need to manage your finances effectively</p>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon bg-primary text-white">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h5>Smart Analytics</h5>
                        <p class="text-muted">Get detailed insights into your spending patterns with beautiful charts and reports.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon bg-success text-white">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h5>Budget Management</h5>
                        <p class="text-muted">Set budgets for different categories and track your progress in real-time.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon bg-warning text-white">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h5>Mobile Responsive</h5>
                        <p class="text-muted">Access your finances anywhere with our mobile-friendly interface.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon bg-info text-white">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h5>Secure & Private</h5>
                        <p class="text-muted">Your financial data is encrypted and secure with bank-level protection.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon bg-danger text-white">
                            <i class="fas fa-bell"></i>
                        </div>
                        <h5>Smart Notifications</h5>
                        <p class="text-muted">Get alerts for budget limits, bill reminders, and important updates.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon bg-secondary text-white">
                            <i class="fas fa-download"></i>
                        </div>
                        <h5>Export & Backup</h5>
                        <p class="text-muted">Export your data in multiple formats and create secure backups.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">Simple Pricing</h2>
                <p class="lead text-muted">Choose the plan that fits your needs</p>
            </div>
            
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="pricing-card">
                        <div class="text-center mb-4">
                            <h4>Free</h4>
                            <div class="display-4 fw-bold text-primary">$0</div>
                            <small class="text-muted">Forever</small>
                        </div>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Up to 100 transactions</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Basic categories</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Simple reports</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Mobile access</li>
                        </ul>
                        <div class="text-center mt-4">
                            <a href="{{ route('register') }}" class="btn btn-outline-primary w-100">Get Started</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="pricing-card featured">
                        <div class="text-center mb-4">
                            <h4>Pro</h4>
                            <div class="display-4 fw-bold text-primary">$9</div>
                            <small class="text-muted">per month</small>
                        </div>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Unlimited transactions</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Custom categories</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Advanced analytics</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Budget alerts</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Export reports</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Priority support</li>
                        </ul>
                        <div class="text-center mt-4">
                            <a href="{{ route('register') }}" class="btn btn-primary w-100">Start Pro Trial</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="pricing-card">
                        <div class="text-center mb-4">
                            <h4>Enterprise</h4>
                            <div class="display-4 fw-bold text-primary">$29</div>
                            <small class="text-muted">per month</small>
                        </div>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Everything in Pro</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Multiple accounts</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Team collaboration</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>API access</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Custom integrations</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Dedicated support</li>
                        </ul>
                        <div class="text-center mt-4">
                            <a href="{{ route('register') }}" class="btn btn-outline-primary w-100">Contact Sales</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">What Our Users Say</h2>
                <p class="lead text-muted">Join thousands of satisfied users</p>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card">
                        <div class="testimonial-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <h5>Sarah Johnson</h5>
                        <p class="text-muted mb-3">Financial Analyst</p>
                        <p>"This app completely changed how I manage my finances. The budgeting features are incredible and the reports are so detailed!"</p>
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card">
                        <div class="testimonial-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <h5>Mike Chen</h5>
                        <p class="text-muted mb-3">Small Business Owner</p>
                        <p>"Perfect for tracking both personal and business expenses. The categorization and reporting features save me hours every month."</p>
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card">
                        <div class="testimonial-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <h5>Emily Rodriguez</h5>
                        <p class="text-muted mb-3">Student</p>
                        <p>"As a student on a tight budget, this app helps me stay on track. The mobile app is so easy to use and the alerts are really helpful."</p>
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Demo Section -->
    <section id="demo" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">See It In Action</h2>
                <p class="lead text-muted">Explore the key features of our finance tracking system</p>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-tachometer-alt fa-3x text-primary mb-3"></i>
                            <h5>Dashboard</h5>
                            <p class="text-muted">Overview of your financial health with key metrics and charts.</p>
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-primary btn-sm">View Demo</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-exchange-alt fa-3x text-success mb-3"></i>
                            <h5>Transactions</h5>
                            <p class="text-muted">Track all your income and expenses with detailed categorization.</p>
                            <a href="{{ route('transactions') }}" class="btn btn-outline-success btn-sm">View Demo</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-chart-pie fa-3x text-warning mb-3"></i>
                            <h5>Budgets</h5>
                            <p class="text-muted">Set and monitor budgets for different spending categories.</p>
                            <a href="{{ route('budgets') }}" class="btn btn-outline-warning btn-sm">View Demo</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-chart-bar fa-3x text-info mb-3"></i>
                            <h5>Reports</h5>
                            <p class="text-muted">Generate detailed reports and analyze your spending trends.</p>
                            <a href="{{ route('reports') }}" class="btn btn-outline-info btn-sm">View Demo</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-4">Ready to Start Your Financial Journey?</h2>
                    <p class="lead text-muted mb-4">
                        Join thousands of users who are already taking control of their finances with our platform.
                    </p>
                    <div class="d-flex gap-3 justify-content-center">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-user-plus me-2"></i>Create Free Account
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-sign-in-alt me-2"></i>Sign In
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-light py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-wallet text-primary me-2"></i>Finance Tracker</h5>
                    <p class="text-muted">Take control of your financial future with our comprehensive tracking system.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="text-muted mb-0">&copy; 2024 Finance Tracker. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 