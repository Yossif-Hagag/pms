<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">
            <h4 class="fw-bold mb-4">
                {{ $role ? 'Edit Role' : 'Create Role' }}
            </h4>

            <form wire:submit.prevent="save">
                <div class="mb-3">
                    <label class="form-label">Role Name</label>
                    <input type="text" wire:model.defer="name" class="form-control">
                    @error('name')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Permissions</label>
                    <div class="row g-2">
                        @foreach ($permissions as $permission)
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $permission->name }}"
                                        wire:model="selectedPermissions">
                                    <label class="form-check-label">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button class="btn btn-success">
                    <i class="fa fa-save me-1"></i> Save
                </button>
            </form>
        </div>
    </div>
</div>
