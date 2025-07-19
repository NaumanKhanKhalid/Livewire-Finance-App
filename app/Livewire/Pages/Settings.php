<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Flasher\Laravel\Facade\Flasher;

class Settings extends Component
{
    public $profileForm = [
        'name' => '',
        'email' => '',
        'timezone' => '',
        'currency' => '',
    ];
    
    public $passwordForm = [
        'current_password' => '',
        'new_password' => '',
        'confirm_password' => '',
    ];
    
    public $preferencesForm = [
        'notifications_enabled' => true,
        'email_reports' => true,
        'budget_alerts' => true,
        'theme' => 'light',
    ];
    
    public $successMessage = null;
    public $errorMessage = null;

    protected function rules()
    {
        return [
            'profileForm.name' => 'required|string|max:255',
            'profileForm.email' => ['required', 'email', Rule::unique('users')->ignore(auth()->id())],
            'profileForm.timezone' => 'required|string',
            'profileForm.currency' => 'required|string|max:3',
            'passwordForm.current_password' => 'required_with:passwordForm.new_password',
            'passwordForm.new_password' => 'nullable|min:8|confirmed:passwordForm.confirm_password',
            'passwordForm.confirm_password' => 'nullable|min:8',
        ];
    }

    public function mount()
    {
        $user = auth()->user();
        $this->profileForm = [
            'name' => $user->name,
            'email' => $user->email,
            'timezone' => $user->timezone ?? 'UTC',
            'currency' => $user->currency ?? 'USD',
        ];
        
        $this->preferencesForm = [
            'notifications_enabled' => $user->notifications_enabled ?? true,
            'email_reports' => $user->email_reports ?? true,
            'budget_alerts' => $user->budget_alerts ?? true,
            'theme' => $user->theme ?? 'light',
        ];
    }

    public function updateProfile()
    {
        $this->validate([
            'profileForm.name' => 'required|string|max:255',
            'profileForm.email' => ['required', 'email', Rule::unique('users')->ignore(auth()->id())],
            'profileForm.timezone' => 'required|string',
            'profileForm.currency' => 'required|string|max:3',
        ]);

        $user = auth()->user();
        $user->update([
            'name' => $this->profileForm['name'],
            'email' => $this->profileForm['email'],
            'timezone' => $this->profileForm['timezone'],
            'currency' => $this->profileForm['currency'],
        ]);

        Flasher::addSuccess('Profile updated successfully!');
    }

    public function updatePassword()
    {
        $this->validate([
            'passwordForm.current_password' => 'required',
            'passwordForm.new_password' => 'required|min:8|confirmed:passwordForm.confirm_password',
            'passwordForm.confirm_password' => 'required|min:8',
        ]);

        $user = auth()->user();
        
        if (!Hash::check($this->passwordForm['current_password'], $user->password)) {
            Flasher::addError('Current password is incorrect.');
            return;
        }

        $user->update([
            'password' => Hash::make($this->passwordForm['new_password']),
        ]);

        $this->passwordForm = [
            'current_password' => '',
            'new_password' => '',
            'confirm_password' => '',
        ];

        Flasher::addSuccess('Password updated successfully!');
    }

    public function updatePreferences()
    {
        $user = auth()->user();
        $user->update([
            'notifications_enabled' => $this->preferencesForm['notifications_enabled'],
            'email_reports' => $this->preferencesForm['email_reports'],
            'budget_alerts' => $this->preferencesForm['budget_alerts'],
            'theme' => $this->preferencesForm['theme'],
        ]);

        Flasher::addSuccess('Preferences updated successfully!');
    }

    public function render()
    {
        return view('livewire.pages.settings');
    }
}
