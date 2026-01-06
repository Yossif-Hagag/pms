<div>
    <style>
        .hover-shadow:hover {
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15) !important;
            transition: box-shadow 0.3s ease, transform 0.2s ease;
            transform: translateY(-2px);
        }

        button.btn {
            transition: all 0.2s ease;
        }

        button.btn:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.25);
        }
    </style>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="bg-white p-5 rounded-4 shadow-sm border">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fs-2 fw-bold text-center text-{{ $role ? 'primary' : 'success' }}">
                            {{ $role ? 'Edit Role' : 'Create Role' }}
                        </h3>
                        <a wire:navigate href="{{ route('roles.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left-circle me-2"></i> Back to Roles
                        </a>
                    </div>

                    <form wire:submit.prevent="save">

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" id="name" wire:model.defer="name"
                                placeholder="Role Name">
                            <label for="name">Role Name</label>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 mt-5">
                            <label class="form-label fw-semibold">Permissions</label>
                            <div class="d-flex flex-wrap">
                                @foreach ($permissions as $permission)
                                    <div class="mx-2 mb-3" style="cursor: pointer;">
                                        <div class="bg-light border rounded-3 px-3 py-2 shadow-sm d-flex align-items-center hover-shadow"
                                            style="cursor: pointer;">
                                            <input class="form-check-input me-2" type="checkbox"
                                                value="{{ $permission->name }}" wire:model="selectedPermissions"
                                                style="cursor: pointer;" id="perm-{{ $permission->id }}">
                                            <label class="form-check-label mb-0 flex-grow-1" style="cursor: pointer;"
                                                for="perm-{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('selectedPermissions')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-center align-items-center">
                            <button type="submit"
                                class="btn btn-{{ $role ? 'primary' : 'success' }} w-75 py-2 rounded-pill fw-semibold"
                                wire:loading.attr="disabled" wire:target="save">
                                <span wire:loading wire:target="save" class="spinner-border spinner-border-sm me-2"
                                    role="status" aria-hidden="true"></span>
                                <span wire:loading.remove wire:target="save">
                                    {{ $role ? 'Update Role' : 'Create Role' }}
                                </span>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
