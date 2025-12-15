<div>
    <div class="container mt-5">
        <div class="card shadow-sm rounded-4 p-4">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0 fw-bold fs-3">{{ $project->name }}</h3>
                <a href="{{ route('projects.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left-circle me-2"></i>
                    Back to Projects
                </a>
            </div>

            <p>
                <strong>Status:</strong>
                <span class="badge bg-{{ $project->status->color() }}">
                    {{ $project->status->label() }}
                </span>
            </p>

            <p><strong>Assigned User:</strong> {{ $project->user?->name ?? 'N/A' }}</p>

            <p><strong>Description:</strong></p>
            <p class="border rounded p-3 bg-light">{{ $project->description ?? 'No description' }}</p>

            <h5 class="mt-4">Tasks ({{ $project->tasks->count() }})</h5>

            @if ($project->tasks->isEmpty())
                <p class="text-muted">No tasks available for this project.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mt-2">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Priority</th>
                                <th>Assigned User</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($project->tasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td class="text-capitalize">
                                        <span class="badge bg-{{ $task->status->color() }}">
                                            {{ $task->status->label() }}
                                        </span>
                                    </td>
                                    <td class="text-capitalize">
                                        <span class="badge bg-{{ $task->priority->color() }}">
                                            {{ $task->priority->label() }}
                                        </span>
                                    </td>
                                    <td>{{ $task->assignedUser?->name ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div>
</div>
