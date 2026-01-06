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
            <div class="col-md-8">

                <div class="bg-white p-5 rounded-4 shadow-sm border">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fs-2 fw-bold text-{{ $user ? 'primary' : 'success' }}">
                            {{ $user ? 'Edit User' : 'Create User' }}
                        </h3>
                        <a wire:navigate href="{{ route('users.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left-circle me-2"></i> Back to Users
                        </a>
                    </div>

                    <form wire:submit.prevent="save">

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-3" wire:model.defer="name"
                                placeholder="Name">
                            <label>Name</label>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control rounded-3" wire:model.defer="email"
                                placeholder="Email">
                            <label>Email</label>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control rounded-3" wire:model.defer="password"
                                placeholder="Password">
                            <label>Password {{ $user ? '(optional)' : '' }}</label>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-4">
                            <input type="password" class="form-control rounded-3"
                                wire:model.defer="password_confirmation" placeholder="Confirm Password">
                            <label>Confirm Password {{ $user ? '(optional)' : '' }}</label>
                        </div>

                        <div class="mb-4 mt-4">
                            <label class="form-label fw-semibold">Role</label>
                            <div class="d-flex flex-wrap">
                                @foreach ($allRoles as $roleOption)
                                    <div class="mx-2 mb-3" style="cursor: pointer;">
                                        <div class="bg-light border rounded-3 px-3 py-2 shadow-sm d-flex align-items-center hover-shadow"
                                            style="cursor: pointer;">
                                            <input class="form-check-input me-2" type="radio"
                                                value="{{ $roleOption->name }}" wire:model="role"
                                                id="role-{{ $roleOption->id }}" style="cursor: pointer;">
                                            <label class="form-check-label mb-0 flex-grow-1" style="cursor: pointer;"
                                                for="role-{{ $roleOption->id }}">
                                                {{ ucfirst($roleOption->name) }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('role')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit"
                            class="btn btn-{{ $user ? 'primary' : 'success' }} w-100 py-2 rounded-pill fw-semibold"
                            wire:loading.attr="disabled" wire:target="save">
                            <span wire:loading wire:target="save" class="spinner-border spinner-border-sm me-2"></span>
                            <span wire:loading.remove wire:target="save">
                                {{ $user ? 'Update User' : 'Create User' }}
                            </span>
                        </button>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
