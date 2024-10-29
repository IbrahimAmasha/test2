<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserManagement extends Component
{
    use WithPagination;

    public $name, $email, $phone, $role_id, $password, $userId;
    public $isEditMode = false;
    public $showAddForm = false; 
    public $showEditForm = false; 
    protected $paginationTheme = 'bootstrap';

    public function updatingPage()
    {
        $this->resetPage();
    }
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'role_id' => 'required', 
    ];

    public function addUser()
    {
        $this->reset(['name', 'email', 'password', 'role_id']);
        $this->dispatch('show-add-user-modal');
    }

    public function saveUser()
    {
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'role_id' => $this->role_id,
            'phone' => $this->phone,
            'password' => bcrypt($this->password),
        ]);

        $this->dispatch('hide-user-modal');
        session()->flash('message', 'User added successfully.');
    }

    public function editUser($id)
    {
        $user = User::find($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->role_id = $user->role_id;

        $this->dispatch('show-edit-user-modal');
    }

    public function updateUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'role_id' => 'required',
        ]);

        $user = User::find($this->userId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'role_id' => $this->role_id,
            'phone' => $this->phone,
        ]);

        $this->dispatch('hide-user-modal');
        session()->flash('message', 'User updated successfully.');
    }

    public function deleteUser($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'User deleted successfully.');
    }

    public function render()
    {

        $users = auth()->user()->role_id == 1 ?
            User::paginate(10)
            :
            User::where('role_id', '!=', 1)->paginate(10);
        return view('livewire.user-management', ['users' => $users]);
    }
}
