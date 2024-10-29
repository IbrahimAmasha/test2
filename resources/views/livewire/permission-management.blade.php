<div>
    <div>
        <h2 class="mb-4">{{ __('messages.permissions_management') }}</h2>
        <button wire:click="addPermission" class="btn btn-primary">{{ __('messages.add_new_permission') }}</button>

        <!-- Add Permission Modal -->
        <div class="modal fade" id="addPermissionModal" tabindex="-1" aria-labelledby="addPermissionModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPermissionModalLabel">{{ __('messages.add_new_permission') }}
                        </h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="savePermission">
                            <div class="form-group">
                                <label for="permissionNameAr">{{ __('messages.permission_name_ar') }}</label>
                                <input type="text" id="permissionNameAr" class="form-control"
                                    wire:model="permissionNameAr" required>
                            </div>
                               <div class="form-group">
                                <label for="permissionNameEn">{{ __('messages.permission_name_en') }}</label>
                                <input type="text" id="permissionNameEn" class="form-control"
                                    wire:model="permissionNameEn" required>
                            </div>
                            <button type="submit" class="btn btn-success">{{ __('messages.save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Permission Modal -->
        <div class="modal fade" id="editPermissionModal" tabindex="-1" aria-labelledby="editPermissionModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPermissionModalLabel">{{ __('messages.edit_permission') }}</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="updatePermission">
                            <div class="form-group">
                                <label for="permissionNameAr">{{ __('messages.permission_name_ar') }}</label>
                                <input type="text" id="permissionNameAr" class="form-control"
                                    wire:model="permissionNameAr" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="permissionNameEn">{{ __('messages.permission_name_en') }}</label>
                                <input type="text" id="permissionNameEn" class="form-control"
                                    wire:model="permissionNameEn" required>
                            </div>
                            <button type="submit" class="btn btn-success">{{ __('messages.update') }}</button>
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

        <table class="table table-hover mt-4">
            <thead>
                <tr>
                    <th>{{ __('messages.permission_name') }}</th>
                    <th>{{ __('messages.operations') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>
                            <button wire:click="editPermission({{ $permission->id }})"
                                class="btn btn-warning">{{ __('messages.edit') }}</button>
                            <button wire:click="deletePermission({{ $permission->id }})"
                                class="btn btn-danger">{{ __('messages.delete') }}</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        {{ $permissions->links('pagination::bootstrap-4') }}
    </div>

    <script>
        window.addEventListener('show-add-permission-modal', event => {
            $('#addPermissionModal').modal('show');
        });

        window.addEventListener('show-edit-permission-modal', event => {
            $('#editPermissionModal').modal('show');
        });

        window.addEventListener('hide-permission-modal', event => {
            $('#addPermissionModal').modal('hide');
            $('#editPermissionModal').modal('hide');
        });

        $('#addPermissionModal, #editPermissionModal').on('hidden.bs.modal', function() {
            Livewire.emit('resetForm');
        });
    </script>
</div>
