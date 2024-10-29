<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

#[Layout('components.layouts.guest')]
class Register extends Component
{

    use WithFileUploads;

    public $name;
    public $email;
    public $phone;
    public $password;
    public $password_confirmation;
    public $photo;


    public function register()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'photo' => 'nullable|image',
        ]);

        $photoPath = $this->photo ?   $this->photo->store('profile-photos', 'public') : null;

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => Hash::make($this->password),
            'photo' => $photoPath,
            'role_id' => 3, //normal user
        ]);

        Auth::login($user);

        return redirect()->route('user.home');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
