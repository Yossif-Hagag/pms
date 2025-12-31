<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="d-flex position-relative">

        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar bg-white shadow position-relative min-vh-100"
            style="transition: all 0.3s;">
            <div class="d-flex flex-column h-100 px-1">

                <!-- Logo -->
                <a wire:navigate href="{{ route('dashboard') }}"
                    class="mmx-2 my-3 d-flex align-items-center mb-5 text-decoration-none">
                    <x-application-logo class="me-2" style="height: 40px; width:auto;" />
                    <span class="fs-5 fw-bold linkTitles mx-2 text-dark">PMS</span>
                </a>

                <!-- Navigation Links -->
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item mb-1 mx-1">
                        <a wire:navigate href="{{ route('dashboard') }}"
                            class="nav-link text-black {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="bi bi-speedometer2 me-2"></i><span class="linkTitles"> Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item mb-1 mx-1">
                        <a wire:navigate href="{{ route('projects.index') }}"
                            class="nav-link text-black {{ request()->routeIs('projects.*') ? 'active' : '' }}">
                            <i class="bi bi-kanban me-2"></i><span class="linkTitles"> Projects</span>
                        </a>
                    </li>
                    <li class="nav-item mb-1 mx-1">
                        <a wire:navigate href="{{ route('tasks.board') }}"
                            class="nav-link text-black {{ request()->routeIs('tasks.*') ? 'active' : '' }}">
                            <i class="bi bi-check2-square me-2"></i><span class="linkTitles"> Tasks</span>
                        </a>
                    </li>
                    <li class="nav-item mb-1 mx-1">
                        <a wire:navigate href="{{ route('profile') }}"
                            class="nav-link text-black {{ request()->routeIs('profile') ? 'active' : '' }}">
                            <i class="bi bi-person-circle me-2"></i><span class="linkTitles"> Profile</span>
                        </a>
                    </li>
                </ul>

                <!-- Logout -->
                <livewire:logout-button />


                <!-- Toggle Arrow -->
                <button id="sidebarToggle"
                    class="arrow btn btn-light position-absolute top-50 end-0 translate-middle-y rounded-circle shadow-sm d-flex justify-content-center align-content-center">
                    <i class="bi bi-chevron-left"></i>
                </button>
            </div>
        </aside>

        <!-- Main content -->
        <main id="mainContent" class="flex-grow-1 p-4 transition" style="transition: margin 0.3s;">
            {{ $slot }}
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Livewire Scripts -->
    @livewireScripts
    {{-- SweetAlert Js --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Delete Confirmation Script --}}
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('confirm-delete-project', ({
                id
            }) => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This project will be deleted permanently!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('delete-project', {
                            id: id
                        });
                    }
                });
            });

            Livewire.on('confirm-delete-task', ({
                id
            }) => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This task will be deleted permanently!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('delete-task', {
                            id: id
                        });
                    }
                });
            });

        });
    </script>
    {{-- Toast Script --}}
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('toast', (payload) => {
                const data = Array.isArray(payload) ? payload[0] : payload;

                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: data.type ?? 'success',
                    title: data.message ?? '',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            });
        });
    </script>
    {{-- Persistent Toast Script --}}
    <script>
        document.addEventListener('livewire:init', () => {

            Livewire.on('store-toast', (payload) => {
                const data = Array.isArray(payload) ? payload[0] : payload;
                localStorage.setItem('toast', JSON.stringify(data));
            });

            window.addEventListener('livewire:navigated', () => {
                const toast = localStorage.getItem('toast');
                if (!toast) return;

                const data = JSON.parse(toast);

                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: data.type ?? 'success',
                    title: data.message ?? '',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });

                localStorage.removeItem('toast');
            });

        });
    </script>
    {{-- Sidebar Toggle Script --}}
    <script>
        function bindSidebarToggle() {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('sidebarToggle');
            const mainContent = document.getElementById('mainContent');

            if (!sidebar || !toggleBtn) return;

            // Prevent multiple bindings
            if (toggleBtn.dataset.bound === '1') return;
            toggleBtn.dataset.bound = '1';

            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('collapsed');

                if (sidebar.classList.contains('collapsed')) {
                    // sidebar.style.width = '65px';
                    toggleBtn.querySelector('i')
                        ?.classList.replace('bi-chevron-left', 'bi-chevron-right');
                } else {
                    // sidebar.style.width = '250px';
                    toggleBtn.querySelector('i')
                        ?.classList.replace('bi-chevron-right', 'bi-chevron-left');
                }
            });
        }

        //first load
        document.addEventListener('DOMContentLoaded', bindSidebarToggle);
        //after Livewire navigation
        document.addEventListener('livewire:navigated', bindSidebarToggle);
    </script>
</body>

</html>
