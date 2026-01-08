<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Project Manager</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container min-vh-100 d-flex align-items-center">
        <div class="row w-100 align-items-center">

            <!-- Left -->
            <div class="col-md-6 mb-4 mb-md-0">
                <h1 class="fw-bold display-5 mb-3">
                    Manage Your Projects <br>
                    <span class="text-primary">Smarter & Faster</span>
                </h1>

                <p class="text-muted fs-5 mb-4">
                    A simple and powerful project management system to organize tasks,
                    track progress, and collaborate efficiently.
                </p>

                <div class="d-flex gap-3">
                    <a wire:navigate href="{{ route('login') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Login
                    </a>

                    <p class="align-self-center text-muted mb-0">
                        New users? Contact your administrator to get an account.
                    </p>
                </div>
            </div>

            <!-- Right -->
            <div class="col-md-6 text-center">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-5">
                        <div class="row g-4">

                            <div class="col-6">
                                <div class="p-4 border rounded-3 h-100">
                                    <i class="bi bi-kanban fs-1 text-primary"></i>
                                    <h6 class="mt-3 fw-semibold">Task Board</h6>
                                    <p class="text-muted small mb-0">
                                        Organize tasks visually
                                    </p>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="p-4 border rounded-3 h-100">
                                    <i class="bi bi-folder-check fs-1 text-success"></i>
                                    <h6 class="mt-3 fw-semibold">Projects</h6>
                                    <p class="text-muted small mb-0">
                                        Track project progress
                                    </p>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="p-4 border rounded-3 h-100">
                                    <i class="bi bi-people fs-1 text-warning"></i>
                                    <h6 class="mt-3 fw-semibold">Teams</h6>
                                    <p class="text-muted small mb-0">
                                        Collaborate easily
                                    </p>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="p-4 border rounded-3 h-100">
                                    <i class="bi bi-bell fs-1 text-danger"></i>
                                    <h6 class="mt-3 fw-semibold">Notifications</h6>
                                    <p class="text-muted small mb-0">
                                        Stay updated
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>
