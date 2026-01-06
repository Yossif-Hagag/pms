<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="row">
                <div class="gap-1 bg-white shadow-sm rounded-3 py-3 w-100">
                    <i class="bi bi-shield-lock-fill fs-6"></i>
                    <span class="text-muted fw-semibold fs-6">My Profile Role</span>
                    <span class="text-muted fs-6">:</span>

                    @php
                        $role = auth()->user()?->getRoleNames()->first();

                        $roleStyles = [
                            'admin' => 'badge-admin',
                            'manager' => 'badge-manager',
                            'staff' => 'badge-staff',
                        ];
                    @endphp

                    <span class="badge rounded-pill px-4 py-2 {{ $roleStyles[$role] ?? 'bg-dark' }}">
                        {{ ucfirst($role ?? 'No Role Assigned') }}
                    </span>


                </div>
            </div>


            <div class="row d-flex justify-content-between">
                <div class="col-md-5 p-6 bg-white shadow-sm sm:rounded-lg">
                    <livewire:profile.update-profile-information-form />
                </div>
                <div class="col-md-6 p-6 bg-white shadow-sm sm:rounded-lg">
                    <livewire:profile.update-password-form />
                </div>
            </div>


            <div class="row p-6 bg-white shadow-sm sm:rounded-lg">
                <livewire:profile.delete-user-form />
            </div>
        </div>
    </div>
</x-app-layout>
