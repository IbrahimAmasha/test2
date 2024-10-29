<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm text-center">
                <div class="card-body p-5">
                    <h2 class="card-title font-weight-bold mb-4">
                        {{ __('messages.welcome_back') . auth()->user()->name . '!' }}</h2>
                    <p class="text-muted">{{ __('messages.glad_to_see_you') }}</p>
                </div>
            </div>
        </div>
    </div>

    @if (auth()->user()->role_id == 1)
        <div class="row mt-5">
            <!-- Roles Stat -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <div class="circle bg-primary text-white mx-auto mb-3">
                            <i class="fas fa-users-cog fa-2x"></i>
                        </div>
                        <h5 class="font-weight-bold">{{ __('messages.roles') }}</h5>
                        <p class="text-muted">{{ App\Models\Role::count() }} {{ __('messages.total_roles') }}</p>
                    </div>
                </div>
            </div>
    @endif

    <!-- Users Stat -->
    <div class="col-md-4 mb-4 mx-auto">
        <div class="card shadow-sm text-center">
            <div class="card-body">
                <div class="circle bg-warning text-white mx-auto mb-3">
                    <i class="fas fa-users fa-2x"></i>
                </div>
                <h5 class="font-weight-bold">{{ __('messages.users') }}</h5>
                <p class="text-muted">{{ App\Models\User::count() }} {{ __('messages.registered_users') }}</p>
            </div>
        </div>
    </div>

    @if (auth()->user()->role_id == 1)
        <!-- Permissions Stat -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <div class="circle bg-success text-white mx-auto mb-3">
                        <i class="fas fa-lock fa-2x"></i>
                    </div>
                    <h5 class="font-weight-bold">{{ __('messages.permissions') }}</h5>
                    <p class="text-muted">{{ App\Models\Permission::count() }} {{ __('messages.total_permissions') }}
                    </p>
                </div>
            </div>
        </div>
    @endif

</div>
</div>
