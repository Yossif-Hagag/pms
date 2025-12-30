<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fs-4 fw-bold">Tasks Board</h2>
            {{-- @can('create task') --}}
            <a wire:navigate href="{{ route('tasks.create') }}" class="btn btn-success"><i
                    class="bi bi-plus-circle me-1"></i> Add
                Task</a>
            {{-- @endcan --}}
    </div>

    <div wire:loading wire:target="delete" class="text-center mb-3">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="row">
        @foreach (App\Enums\TaskStatus::options() as $status)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-header text-capitalize font-weight-bold">
                        {{ $status['label'] }}
                    </div>
                    <ul class="list-group list-group-flush vh-100 overflow-auto">
                        @foreach ($tasks->where('status', $status['value']) as $task)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-bold">{{ $task->title }}</div>
                                    <div class="text-muted small"><span class="fw-bold">Project:
                                        </span>{{ $task->project->name }}</div>
                                    <div class="text-muted small"><span class="fw-bold">Assigned:
                                        </span>{{ $task->assignedUser?->name ?? 'N/A' }}
                                    </div>
                                </div>
                                <div class="btn-group btn-group-sm">
                                    {{-- @can('edit task') --}}
                                    <a wire:navigate href="{{ route('tasks.edit', $task) }}"
                                        wire:loading.attr="disabled" class="btn btn-outline-primary"><i
                                            class="bi bi-pencil"></i></a>
                                    {{-- @endcan --}}
                                    {{-- @can('delete task') --}}
                                    <button wire:navigate
                                        wire:click="$dispatch('confirm-delete', { id: '{{ $task->id }}' })"
                                        wire:loading.attr="disabled" class="btn btn-outline-danger"><i
                                            class="bi bi-trash"></i></button>
                                    {{-- @endcan --}}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
</div>
