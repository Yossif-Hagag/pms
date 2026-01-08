<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold fs-4">Users</h2>

        @can('create user')
            <a wire:navigate href="{{ route('users.create') }}" class="btn btn-success">
                <i class="bi bi-person-plus me-1"></i> New User
            </a>
        @endcan
    </div>

    <div class="row g-4">
        @foreach ($users as $user)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100"
                    style="border-right: 1px solid rgba(31,41,55,1) !important; padding: 10px;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-semibold mb-0">
                                <i class="fa fa-user text-primary me-1"></i>
                                {{ $user->name }}
                            </h5>

                            <div class="btn-group btn-group-sm">
                                @can('edit user')
                                    <a wire:navigate href="{{ route('users.edit', $user) }}" wire:loading.attr="disabled"
                                        class="btn btn-outline-primary rounded mx-1"><i class="bi bi-pencil"></i></a>
                                @endcan
                                @can('delete user')
                                    <button wire:navigate
                                        wire:click="$dispatch('confirm-delete-user', { id: '{{ $user->id }}' })"
                                        wire:loading.attr="disabled" class="btn btn-outline-danger rounded"><i
                                            class="bi bi-trash"></i></button>
                                @endcan
                            </div>
                        </div>

                        <p class="text-muted small mb-2">{{ $user->email }}</p>

                        <div class="d-flex flex-wrap gap-2">
                            @php
                                $roleStyles = [
                                    'admin' => 'badge-admin',
                                    'manager' => 'badge-manager',
                                    'staff' => 'badge-staff',
                                ];
                            @endphp
                            @foreach ($user->roles as $role)
                                <span
                                    class="badge text-dark border text-white {{ $roleStyles[$role->name] ?? 'bg-dark' }}">
                                    {{ $role->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
