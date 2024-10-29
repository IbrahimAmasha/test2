<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EditProfile extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $photo;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore(auth()->user()->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'photo' => 'nullable|image',
        ];
    }

    public function mount()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function updateProfile()
    {
        $this->validate();

        $user = auth()->user();
        $user->name = $this->name;
        $user->email = $this->email;

        if ($this->password) {
            $user->password = bcrypt($this->password);
        }

        if ($this->photo) {
            if ($user->photo) {
                Storage::delete($user->photo);
            }

            $user->photo = $this->photo->store('profile-photos', 'public');
        }

        $user->save();

        session()->flash('message', 'Profile updated successfully!');
        return redirect()->route('edit.profile');
    }

    public function render()
    {
        return view('livewire.edit-profile');
    }
}
