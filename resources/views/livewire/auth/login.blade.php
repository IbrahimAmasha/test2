<div>
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="text-center mb-4">
        <h4 class="font-weight-bold">Hello! Let's get started</h4>
        <h6 class="font-weight-light text-muted">Sign in to continue.</h6>
    </div>

    <form wire:submit.prevent="login" class="pt-3 shadow-sm p-4 rounded bg-white">  
        <div class="form-group">
            <input type="text" class="form-control form-control-lg" placeholder="Email or Phone" wire:model="loginInput" required>
            @error('loginInput')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <input type="password" class="form-control form-control-lg" placeholder="Password" wire:model="password" required>
            @error('password')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
        </div>

        <div class="my-3 d-flex justify-content-between align-items-center">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" wire:model="remember" id="remember">
                <label class="form-check-label text-muted" for="remember">Keep me signed in</label>
            </div>
        </div>

        <div class="text-center mt-4 font-weight-light"> 
            Don't have an account? <a href="{{ route('register') }}" class="text-primary">Create</a>
        </div>
    </form>
</div>
