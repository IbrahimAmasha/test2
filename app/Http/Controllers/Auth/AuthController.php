<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('livewire.auth.login'); 
    }

    // Show the registration form
    public function showRegisterForm()
    {
        return view('livewire.auth.register'); 
    }

    // Handle logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login'); // Redirect after logout
    }
}
