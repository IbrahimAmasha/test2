<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.guest')]
class Login extends Component
{
    public $loginInput; // بor both email or phone input
    public $password;
    public $remember = false;

    public function login()
    {
        // Validate the form data
        $this->validate([
            'loginInput' => 'required|string',
            'password' => 'required|string',
        ]);

        // يetermine if loginInput is email or phone number
        $fieldType = is_numeric($this->loginInput) ? 'phone' : 'email';

        $credentials = [
            $fieldType => $this->loginInput,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials, $this->remember)) {
            $role_id = auth()->user()->role_id;

            if ($role_id == 3) {  // normal user
                return redirect()->route('user.home');
            } else {
                return redirect()->route('admin.dashboard');  // admin or super admin
            }
        }

        session()->flash('error', 'Invalid credentials. Please try again.');
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
