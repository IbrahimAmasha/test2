<div>
    <h4>New here?</h4>
    <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
    <form wire:submit="register" enctype="multipart/form-data">
        <div class="form-group">
            <input type="text" class="form-control form-control-lg" placeholder="Name" wire:model="name" required>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <input type="email" class="form-control form-control-lg" placeholder="Email" wire:model="email" required>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <input type="text" class="form-control form-control-lg" placeholder="Phone" wire:model="phone" required>
            @error('phone')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" class="form-control form-control-lg" placeholder="Password" wire:model="password"
                required>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" class="form-control form-control-lg" placeholder="Confirm Password"
                wire:model="password_confirmation" required>
        </div>
        <div class="form-group">
            <label for="photo">Upload Photo</label>
            <input type="file" class="form-control-file" id="photo" wire:model="photo">
            @error('photo')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN
                UP</button>
        </div>
        <div class="text-center mt-4 font-weight-light">
            Already have an account? <a href="{{ route('login') }}" class="text-primary">Login</a>
        </div>
    </form>
</div>
