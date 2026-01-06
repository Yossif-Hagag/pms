<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 fs-4 fw-bold">Roles & Permissions</h2>

        {{-- @can('create role') --}}
        <a wire:navigate href="{{ route('roles.create') }}" class="btn btn-success"><i class="bi bi-plus-circle me-1"></i>
            New Role</a>
        {{-- @endcan --}}
    </div>

    <div class="row g-4">
        @foreach ($roles as $role)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0 rounded-4"
                    style="border-right: 1px solid rgba(31,41,55,1) !important; padding: 10px;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5
                                class="fw-semibold mb-0 text-capitalize {{ $role->name === 'admin' ? 'text-danger' : 'text-dark' }}">
                                <i class="fa fa-user-shield me-1 text-primary"></i>
                                {{ $role->name }}
                            </h5>

                            @if ($role->name !== 'admin')
                                <div class="btn-group" role="group" aria-label="Actions">
                                    {{-- @can('edit role') --}}
                                    <a wire:navigate href="{{ route('roles.edit', $role) }}"
                                        class="btn btn-sm btn-outline-primary" wire:loading.attr="disabled"
                                        style="border-width: 1px 0px 1px 1px;">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    {{-- @endcan --}}
                                    {{-- @can('delete role') --}}
                                    <button wire:click="$dispatch('confirm-delete-role', { id: '{{ $role->id }}' })"
                                        wire:loading.attr="disabled" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    {{-- @endcan --}}
                                </div>
                            @endif
                        </div>


                        @if ($role->permissions->count())
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($role->permissions as $permission)
                                    <span class="badge bg-light text-dark border px-2 py-1">
                                        {{ $permission->name }}
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <span class="text-muted small">No permissions assigned</span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
