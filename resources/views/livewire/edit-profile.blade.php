<div class="container-fluid page-body-wrapper d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="p-4 border rounded shadow" style="width: 400px;">
        <form wire:submit.prevent="updateProfile">
            <h2 class="mb-4 text-center">{{ __('messages.update_profile') }}</h2>

            <div class="mb-3">
                <label for="name" class="form-label">{{ __('messages.name') }}:</label>
                <input type="text" id="name" wire:model="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">{{ __('messages.email') }}:</label>
                <input type="email" id="email" wire:model="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">{{ __('messages.new_password') }}:</label>
                <input type="password" id="password" wire:model="password" class="form-control">
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">{{ __('messages.confirm_new_password') }}:</label>
                <input type="password" id="password_confirmation" wire:model="password_confirmation"
                    class="form-control">
            </div>

            <div class="mb-3">
                <label for="photo" class="form-label">{{ __('messages.profile_photo') }}:</label>
                <input type="file" id="photo" wire:model="photo" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary w-100">{{ __('messages.update_profile') }}</button>

            @if (session()->has('message'))
                <div class="alert alert-success mt-3">{{ session('message') }}</div>
            @endif
        </form>
    </div>
</div>
