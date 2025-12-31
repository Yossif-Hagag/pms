<div>
    <div class="container mt-5">
        <div class="card shadow-sm rounded-4 p-4">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="mb-0 fw-bold fs-3">{{ $task->title }}</h3>
                </div>

                <a wire:navigate href="{{ route('tasks.board') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left-circle me-2"></i>
                    Back to Tasks
                </a>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-circle-fill text-{{ $task->status->color() }}"></i>
                        <strong>Status:</strong>
                        <span class="badge bg-{{ $task->status->color() }}">
                            {{ $task->status->label() }}
                        </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-flag-fill text-{{ $task->priority->color() }}"></i>
                        <strong>Priority:</strong>
                        <span class="badge bg-{{ $task->priority->color() }}">
                            {{ $task->priority->label() }}
                        </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-person"></i>
                        <strong>Assigned:</strong>
                        <span>{{ $task->assignedUser?->name ?? 'N/A' }}</span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-calendar-event"></i>
                        <strong>Due Date:</strong>
                        <span>{{ $task->due_date?->format('d M Y') ?? 'N/A' }}</span>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-folder"></i>
                        <strong>Project:</strong>

                        @if ($task->project)
                            <a wire:navigate href="{{ route('projects.view', $task->project->id) }}"
                                class="badge bg-light text-primary border text-decoration-none">
                                {{ $task->project->name }}
                            </a>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </div>
                </div>
            </div>

            <div>
                <h6 class="fw-semibold mb-2">Description</h6>
                <div class="border rounded-3 p-3 bg-light">
                    {{ $task->description ?? 'No description provided.' }}
                </div>
            </div>

        </div>
    </div>
</div>
