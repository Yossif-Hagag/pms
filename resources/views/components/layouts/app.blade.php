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


    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    {{-- <div class="min-h-screen bg-light">
        <livewire:layout.navigation />

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="container py-4">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="container my-4">
            {{ $slot }}
        </main>
    </div> --}}

    <div class="d-flex position-relative">

        <!-- Sidebar -->
        <aside id="sidebar" class="bg-white shadow vh-100 position-relative"
            style="width: 250px; transition: all 0.3s;">
            <div class="d-flex flex-column h-100 px-1">

                <!-- Logo -->
                <a href="{{ route('dashboard') }}"
                    class="mmx-2 my-3 d-flex align-items-center mb-4 text-decoration-none">
                    <x-application-logo class="me-2" style="height: 40px; width:auto;" />
                    <span class="fs-5 fw-bold linkTitles">PMS</span>
                </a>

                <!-- Navigation Links -->
                <ul class="nav nav-pills flex-column flex-grow-1">
                    <li class="nav-item mb-1">
                        <a href="{{ route('dashboard') }}"
                            class="nav-link text-black {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="bi bi-speedometer2 me-2"></i><span class="linkTitles"> Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item mb-1">
                        <a href="{{ route('projects.index') }}"
                            class="nav-link text-black {{ request()->routeIs('projects.*') ? 'active' : '' }}">
                            <i class="bi bi-kanban me-2"></i><span class="linkTitles"> Projects</span>
                        </a>
                    </li>
                    <li class="nav-item mb-1">
                        <a href="{{ route('profile') }}"
                            class="nav-link text-black {{ request()->routeIs('profile') ? 'active' : '' }}">
                            <i class="bi bi-person-circle me-2"></i><span class="linkTitles"> Profile</span>
                        </a>
                    </li>
                </ul>

                <!-- Logout -->
                <button wire:click="logout" class="btn btn-outline-danger mt-auto text-start mb-2">
                    <i class="bi bi-box-arrow-right me-2"></i><span class="linkTitles"> Log Out</span>
                </button>

                <!-- Toggle Arrow -->
                <button id="sidebarToggle"
                    class="btn btn-light position-absolute top-50 end-0 translate-middle-y rounded-circle shadow-sm"
                    style="width: 35px; height: 35px; z-index: 999;">
                    <i class="bi bi-chevron-left"></i>
                </button>
            </div>
        </aside>

        <!-- Main content -->
        <main id="mainContent" class="flex-grow-1 p-4 transition" style="transition: margin 0.3s;">
            {{ $slot }}
        </main>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('sidebarToggle');
        const mainContent = document.getElementById('mainContent');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            if (sidebar.classList.contains('collapsed')) {
                sidebar.style.width = '65px';
                mainContent.style.marginLeft = '0px';
                toggleBtn.querySelector('i').classList.remove('bi-chevron-left');
                toggleBtn.querySelector('i').classList.add('bi-chevron-right');
            } else {
                sidebar.style.width = '250px';
                mainContent.style.marginLeft = '0px';
                toggleBtn.querySelector('i').classList.remove('bi-chevron-right');
                toggleBtn.querySelector('i').classList.add('bi-chevron-left');
            }
        });
    </script>

    <style>
        #sidebar.collapsed .nav-link span,
        #sidebar.collapsed span.linkTitles {
            display: none;
        }

        #sidebarToggle {
            border: none;
            background-color: white;
        }

        #sidebar .nav-link {
            border-radius: 8px;
            margin-bottom: 4px;
            transition: all 0.2s;
        }

        #sidebar .nav-link.active {
            background-color: #0d6efd;
            color: white !important;
        }

        #sidebar .nav-link:hover {
            background-color: #e9ecef;
        }
    </style>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Livewire Scripts -->
    @livewireScripts
</body>

</html>
