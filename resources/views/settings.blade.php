@extends('layouts.app')

@section('title', 'Settings')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Settings</h1>
        </div>
    </div>
</div>

<div class="row">
    <!-- Settings Navigation -->
    <div class="col-xl-3 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="nav flex-column nav-pills" id="settings-tab" role="tablist">
                    <button class="nav-link active" id="profile-tab" data-bs-toggle="pill" data-bs-target="#profile" type="button" role="tab">
                        <i class="fas fa-user me-2"></i>Profile Settings
                    </button>
                    <button class="nav-link" id="preferences-tab" data-bs-toggle="pill" data-bs-target="#preferences" type="button" role="tab">
                        <i class="fas fa-cog me-2"></i>Preferences
                    </button>
                    <button class="nav-link" id="security-tab" data-bs-toggle="pill" data-bs-target="#security" type="button" role="tab">
                        <i class="fas fa-shield-alt me-2"></i>Security
                    </button>
                    <button class="nav-link" id="notifications-tab" data-bs-toggle="pill" data-bs-target="#notifications" type="button" role="tab">
                        <i class="fas fa-bell me-2"></i>Notifications
                    </button>
                    <button class="nav-link" id="export-tab" data-bs-toggle="pill" data-bs-target="#export" type="button" role="tab">
                        <i class="fas fa-download me-2"></i>Export Data
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Settings Content -->
    <div class="col-xl-9">
        <div class="tab-content" id="settings-tabContent">
            <!-- Profile Settings -->
            <div class="tab-pane fade show active" id="profile" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Profile Settings</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" value="John">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" value="Doe">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" value="john.doe@example.com">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Profile Picture</label>
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <img src="https://via.placeholder.com/80x80" class="rounded-circle" alt="Profile">
                                    </div>
                                    <div>
                                        <input type="file" class="form-control" accept="image/*">
                                        <small class="text-muted">Upload a new profile picture</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Currency</label>
                                    <select class="form-select">
                                        <option value="USD" selected>USD - US Dollar</option>
                                        <option value="EUR">EUR - Euro</option>
                                        <option value="GBP">GBP - British Pound</option>
                                        <option value="JPY">JPY - Japanese Yen</option>
                                        <option value="CAD">CAD - Canadian Dollar</option>
                                        <option value="AUD">AUD - Australian Dollar</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Timezone</label>
                                    <select class="form-select">
                                        <option value="UTC-5" selected>Eastern Time (UTC-5)</option>
                                        <option value="UTC-6">Central Time (UTC-6)</option>
                                        <option value="UTC-7">Mountain Time (UTC-7)</option>
                                        <option value="UTC-8">Pacific Time (UTC-8)</option>
                                        <option value="UTC+0">UTC</option>
                                        <option value="UTC+1">Central European Time (UTC+1)</option>
                                    </select>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Preferences -->
            <div class="tab-pane fade" id="preferences" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Preferences</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label class="form-label">Default Transaction Type</label>
                                <select class="form-select">
                                    <option value="expense" selected>Expense</option>
                                    <option value="income">Income</option>
                                    <option value="transfer">Transfer</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Default Account</label>
                                <select class="form-select">
                                    <option value="">Select Default Account</option>
                                    <option value="1" selected>Bank Account</option>
                                    <option value="2">Credit Card</option>
                                    <option value="3">Cash</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Date Format</label>
                                <select class="form-select">
                                    <option value="Y-m-d" selected>YYYY-MM-DD</option>
                                    <option value="m/d/Y">MM/DD/YYYY</option>
                                    <option value="d/m/Y">DD/MM/YYYY</option>
                                    <option value="M d, Y">Jan 15, 2024</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Number Format</label>
                                <select class="form-select">
                                    <option value="1,234.56" selected>1,234.56 (US)</option>
                                    <option value="1.234,56">1.234,56 (EU)</option>
                                    <option value="1 234.56">1 234.56 (Space)</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="autoCategorize" checked>
                                    <label class="form-check-label" for="autoCategorize">
                                        Enable auto-categorization
                                    </label>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="recurringTransactions" checked>
                                    <label class="form-check-label" for="recurringTransactions">
                                        Enable recurring transactions
                                    </label>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="budgetAlerts" checked>
                                    <label class="form-check-label" for="budgetAlerts">
                                        Enable budget alerts
                                    </label>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Save Preferences</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Security -->
            <div class="tab-pane fade" id="security" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Security Settings</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label class="form-label">Current Password</label>
                                <input type="password" class="form-control" placeholder="Enter current password">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" class="form-control" placeholder="Enter new password">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" placeholder="Confirm new password">
                            </div>
                            
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="twoFactorAuth">
                                    <label class="form-check-label" for="twoFactorAuth">
                                        Enable two-factor authentication
                                    </label>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="loginNotifications" checked>
                                    <label class="form-check-label" for="loginNotifications">
                                        Notify on new login
                                    </label>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Notifications -->
            <div class="tab-pane fade" id="notifications" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Notification Settings</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <h6 class="mb-3">Email Notifications</h6>
                            
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="weeklyReport" checked>
                                    <label class="form-check-label" for="weeklyReport">
                                        Weekly spending report
                                    </label>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="budgetAlertsEmail" checked>
                                    <label class="form-check-label" for="budgetAlertsEmail">
                                        Budget limit alerts
                                    </label>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="billReminders" checked>
                                    <label class="form-check-label" for="billReminders">
                                        Bill due reminders
                                    </label>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="securityAlerts" checked>
                                    <label class="form-check-label" for="securityAlerts">
                                        Security alerts
                                    </label>
                                </div>
                            </div>
                            
                            <hr>
                            
                            <h6 class="mb-3">Push Notifications</h6>
                            
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="pushBudgetAlerts" checked>
                                    <label class="form-check-label" for="pushBudgetAlerts">
                                        Budget alerts
                                    </label>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="pushBillReminders" checked>
                                    <label class="form-check-label" for="pushBillReminders">
                                        Bill reminders
                                    </label>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="pushGoals" checked>
                                    <label class="form-check-label" for="pushGoals">
                                        Savings goal updates
                                    </label>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Save Notification Settings</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Export Data -->
            <div class="tab-pane fade" id="export" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Export Data</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="card border">
                                    <div class="card-body text-center">
                                        <i class="fas fa-file-pdf fa-3x text-danger mb-3"></i>
                                        <h6>Export as PDF</h6>
                                        <p class="text-muted">Download your financial data as a PDF report</p>
                                        <button class="btn btn-outline-danger">Export PDF</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <div class="card border">
                                    <div class="card-body text-center">
                                        <i class="fas fa-file-excel fa-3x text-success mb-3"></i>
                                        <h6>Export as Excel</h6>
                                        <p class="text-muted">Download your data in Excel format for analysis</p>
                                        <button class="btn btn-outline-success">Export Excel</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <div class="card border">
                                    <div class="card-body text-center">
                                        <i class="fas fa-file-csv fa-3x text-primary mb-3"></i>
                                        <h6>Export as CSV</h6>
                                        <p class="text-muted">Download raw data in CSV format</p>
                                        <button class="btn btn-outline-primary">Export CSV</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <div class="card border">
                                    <div class="card-body text-center">
                                        <i class="fas fa-download fa-3x text-warning mb-3"></i>
                                        <h6>Backup All Data</h6>
                                        <p class="text-muted">Create a complete backup of your account</p>
                                        <button class="btn btn-outline-warning">Create Backup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="alert alert-warning">
                            <h6><i class="fas fa-exclamation-triangle me-2"></i>Important</h6>
                            <p class="mb-0">Exporting data may take a few minutes depending on the amount of data. You will receive an email when the export is ready.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 