<div class="settings-container">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
<div>
            <h4 class="mb-1">Settings</h4>
            <p class="text-muted mb-0">Manage your account and preferences</p>
        </div>
    </div>

    <!-- Settings Tabs -->
    <div class="row">
        <div class="col-md-3">
            <div class="nav flex-column nav-pills" id="settings-tab" role="tablist">
                <button class="nav-link active" id="profile-tab" data-bs-toggle="pill" data-bs-target="#profile" type="button" role="tab">
                    <i class="fas fa-user me-2"></i>Profile
                </button>
                <button class="nav-link" id="password-tab" data-bs-toggle="pill" data-bs-target="#password" type="button" role="tab">
                    <i class="fas fa-lock me-2"></i>Password
                </button>
                <button class="nav-link" id="preferences-tab" data-bs-toggle="pill" data-bs-target="#preferences" type="button" role="tab">
                    <i class="fas fa-cog me-2"></i>Preferences
                </button>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content" id="settings-tabContent">
                <!-- Profile Tab -->
                <div class="tab-pane fade show active" id="profile" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Profile Information</h6>
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent="updateProfile">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" class="form-control @error('profileForm.name') is-invalid @enderror" wire:model.defer="profileForm.name">
                                            @error('profileForm.name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Email Address</label>
                                            <input type="email" class="form-control @error('profileForm.email') is-invalid @enderror" wire:model.defer="profileForm.email">
                                            @error('profileForm.email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Timezone</label>
                                            <select class="form-select @error('profileForm.timezone') is-invalid @enderror" wire:model.defer="profileForm.timezone">
                                                <option value="UTC">UTC</option>
                                                <option value="America/New_York">Eastern Time</option>
                                                <option value="America/Chicago">Central Time</option>
                                                <option value="America/Denver">Mountain Time</option>
                                                <option value="America/Los_Angeles">Pacific Time</option>
                                                <option value="Europe/London">London</option>
                                                <option value="Europe/Paris">Paris</option>
                                                <option value="Asia/Tokyo">Tokyo</option>
                                            </select>
                                            @error('profileForm.timezone') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Currency</label>
                                            <select class="form-select @error('profileForm.currency') is-invalid @enderror" wire:model.defer="profileForm.currency">
                                                <option value="USD">USD ($)</option>
                                                <option value="EUR">EUR (€)</option>
                                                <option value="GBP">GBP (£)</option>
                                                <option value="JPY">JPY (¥)</option>
                                                <option value="CAD">CAD (C$)</option>
                                                <option value="AUD">AUD (A$)</option>
                                            </select>
                                            @error('profileForm.currency') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="updateProfile">
                                    <span wire:loading wire:target="updateProfile" class="spinner-border spinner-border-sm me-2"></span>
                                    Update Profile
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Password Tab -->
                <div class="tab-pane fade" id="password" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Change Password</h6>
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent="updatePassword">
                                <div class="mb-3">
                                    <label class="form-label">Current Password</label>
                                    <input type="password" class="form-control @error('passwordForm.current_password') is-invalid @enderror" wire:model.defer="passwordForm.current_password">
                                    @error('passwordForm.current_password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">New Password</label>
                                            <input type="password" class="form-control @error('passwordForm.new_password') is-invalid @enderror" wire:model.defer="passwordForm.new_password">
                                            @error('passwordForm.new_password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Confirm New Password</label>
                                            <input type="password" class="form-control @error('passwordForm.confirm_password') is-invalid @enderror" wire:model.defer="passwordForm.confirm_password">
                                            @error('passwordForm.confirm_password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="updatePassword">
                                    <span wire:loading wire:target="updatePassword" class="spinner-border spinner-border-sm me-2"></span>
                                    Change Password
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Preferences Tab -->
                <div class="tab-pane fade" id="preferences" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">User Preferences</h6>
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent="updatePreferences">
                                <div class="mb-3">
                                    <label class="form-label">Theme</label>
                                    <select class="form-select" wire:model.defer="preferencesForm.theme">
                                        <option value="light">Light Theme</option>
                                        <option value="dark">Dark Theme</option>
                                        <option value="auto">Auto (System)</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" wire:model.defer="preferencesForm.notifications_enabled">
                                        <label class="form-check-label">Enable Notifications</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" wire:model.defer="preferencesForm.email_reports">
                                        <label class="form-check-label">Email Reports</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" wire:model.defer="preferencesForm.budget_alerts">
                                        <label class="form-check-label">Budget Alerts</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="updatePreferences">
                                    <span wire:loading wire:target="updatePreferences" class="spinner-border spinner-border-sm me-2"></span>
                                    Save Preferences
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .settings-container {
            padding: 1.5rem;
        }
        .nav-pills .nav-link {
            color: #6c7280;
            border-radius: 0.5rem;
            margin-bottom: 0.5rem;
        }
        .nav-pills .nav-link.active {
            background-color: var(--primary-color);
            color: white;
        }
        .nav-pills .nav-link:hover {
            background-color: #f3f4f6;
        }
    </style>
</div>
