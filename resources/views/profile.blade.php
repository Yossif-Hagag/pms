<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="row d-flex justify-content-between">
                <div class="col-md-5 mt-3 p-6 bg-white shadow sm:rounded-lg">
                    <livewire:profile.update-profile-information-form />
                </div>
                <div class="col-md-5 mt-3 p-6 bg-white shadow sm:rounded-lg">
                    <livewire:profile.update-password-form />
                </div>
            </div>


            <div class="row p-6 bg-white shadow sm:rounded-lg">
                <livewire:profile.delete-user-form />
            </div>
        </div>
    </div>
</x-app-layout>
