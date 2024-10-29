<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $isSuperAdmin;

    public function render()
    {
        return view('livewire.dashboard');
    }
}
