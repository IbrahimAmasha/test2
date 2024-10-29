<div class="user-management">
    <div>
        <h2 class="mb-4">@lang('messages.user_manage')</h2>
        <div>
            {{-- only super admin can add new users --}}
            @if (auth()->user()->role_id == 1)
                <button wire:click="addUser" class="btn btn-primary">@lang('messages.add_new_user')</button>
            @endif
            <!-- Add User Modal -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addUserModalLabel">@lang('messages.add_new_user')</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit.prevent="saveUser">
                                <div class="form-group">
                                    <label for="name">@lang('messages.name')</label>
                                    <input type="text" id="name" class="form-control" wire:model="name"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="email">@lang('messages.email')</label>
                                    <input type="email" id="email" class="form-control" wire:model="email"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">@lang('messages.phone')</label>
                                    <input type="text" id="phone" class="form-control" wire:model="phone"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="role_id">@lang('messages.role')</label>
                                    <select wire:model="role_id" class="form-control mb-2">
                                        @foreach (App\Models\Role::all() as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="password">@lang('messages.password')</label>
                                    <input type="password" id="password" class="form-control" wire:model="password"
                                        required>
                                </div>
                                <button type="submit" class="btn btn-success">@lang('messages.save')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit User Modal -->
            <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editUserModalLabel">@lang('messages.edit_user')</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit.prevent="updateUser">
                                <div class="form-group">
                                    <label for="name">@lang('messages.name')</label>
                                    <input type="text" id="name" class="form-control" wire:model="name"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="email">@lang('messages.email')</label>
                                    <input type="email" id="email" class="form-control" wire:model="email"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">@lang('messages.phone')</label>
                                    <input type="text" id="phone" class="form-control" wire:model="phone"
                                        required>
                                </div>

                                {{-- only super admin can change any user's role --}}
                                @if (auth()->user()->role->name == 'Super admin')

                                    <div class="form-group">
                                        <label for="role_id">@lang('messages.role')</label>
                                        <select wire:model="role_id" class="form-control mb-2">
                                            <option selected>@lang('messages.choose_role')</option>
                                            @foreach (App\Models\Role::all() as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                <button type="submit" class="btn btn-success">@lang('messages.update')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Flash message for success -->
            @if (session()->has('message'))
                <div class="alert alert-success mt-3">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <!-- Table for Displaying Users -->
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>@lang('messages.name')</th>
                                <th>@lang('messages.email')</th>
                                <th>@lang('messages.phone')</th>
                                <th>@lang('messages.role')</th>
                                <th>@lang('messages.operations')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->role->name }}</td>
                                    <td>
                                        @if ($user->id == 1 && auth()->user()->id != 1)
                                            @continue
                                        @endif
                                        <button wire:click="editUser({{ $user->id }})"
                                            class="btn btn-warning">@lang('messages.edit')</button>
                                        <button wire:click="deleteUser({{ $user->id }})"
                                            class="btn btn-danger">@lang('messages.delete')</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Pagination -->
        {{ $users->links('vendor.pagination.default') }}
    </div>

    <script>
        // Listen for the events from Livewire to show and hide the modals
        window.addEventListener('show-add-user-modal', event => {
            $('#addUserModal').modal('show');
        });

        window.addEventListener('show-edit-user-modal', event => {
            $('#editUserModal').modal('show');
        });

        window.addEventListener('hide-user-modal', event => {
            $('#addUserModal').modal('hide');
            $('#editUserModal').modal('hide');
        });

        // Reset form fields when either modal is closed
        $('#addUserModal, #editUserModal').on('hidden.bs.modal', function() {
            Livewire.emit('resetForm');
        });
    </script>
</div>
