<?php

use App\Livewire\Home;
use App\Livewire\Dashboard;
use App\Livewire\Auth\Login;
use App\Http\Middleware\User;
use App\Livewire\EditProfile;
use App\Http\Middleware\Admin;
use App\Livewire\Auth\Register;
use App\Livewire\RoleManagement;
use App\Livewire\UserManagement;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;
use App\Livewire\PermissionManagement;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;

// Public Routes

Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();
        if ($user->role_id == 1 || $user->role_id == 2) {
            // Redirect to  admin dashboard
            return redirect()->route('admin.dashboard');
        } else {
            // Redirect to user home
            return redirect()->route('user.home');
        }
    }

    return redirect()->route('login');
})->name('/');


Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');
});

Route::get('edit-profile', EditProfile::class)->name('edit.profile');

// Middleware to handle locale switching
Route::get('language/switch/{locale}', [UserController::class, 'switchLanguage'])
    ->middleware(SetLocale::class)
    ->name('language.switch');

// Admin Routes Group
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('user-management', UserManagement::class)->name('user.management');
    Route::get('role-management', RoleManagement::class)->name('role.management');
    Route::get('permission-management', PermissionManagement::class)->name('permission.management');
});

// Client Routes Group
Route::middleware('user')->prefix('user')->name('user.')->group(function () {
    Route::get('home', Home::class)->name('home');

});

Route::post('logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
