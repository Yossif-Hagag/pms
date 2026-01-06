<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fs-4 fw-bold">Projects Dashboard</h1>
        {{-- @can('create project') --}}
        <a wire:navigate href="{{ route('projects.create') }}" class="btn btn-success"><i
                class="bi bi-plus-circle me-1"></i> Add Project</a>
        {{-- @endcan --}}
    </div>

    <div wire:loading wire:target="delete" class="text-center mb-3">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Assigned User</th>
                    <th>Tasks Count</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr class="">
                        <td>{{ $project->name }}</td>
                        <td class="text-capitalize">
                            <span class="badge bg-{{ $project->status->color() }}">
                                {{ $project->status->label() }}
                            </span>
                        </td>
                        <td>{{ $project->user?->name ?? 'N/A' }}</td>
                        <td>{{ $project->tasks->count() }}</td>
                        <td class="d-flex justify-content-center align-content-center">
                            {{-- @can('view project') --}}
                            <a wire:navigate href="{{ route('projects.view', $project) }}"
                                class="btn btn-sm btn-info me-1" wire:loading.attr="disabled">
                                <i class="bi bi-eye"></i>
                            </a>
                            {{-- @endcan --}}
                            {{-- @can('edit project') --}}
                            <a wire:navigate href="{{ route('projects.edit', $project) }}"
                                class="btn btn-sm btn-primary me-1" wire:loading.attr="disabled">
                                <i class="bi bi-pencil"></i>
                            </a>
                            {{-- @endcan --}}
                            {{-- @can('delete project') --}}
                            <button wire:click="$dispatch('confirm-delete-project', { id: '{{ $project->id }}' })"
                                wire:loading.attr="disabled" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                            {{-- @endcan --}}
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $projects->links() }}
        </div>
    </div>
</div>
