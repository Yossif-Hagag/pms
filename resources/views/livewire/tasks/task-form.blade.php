<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="bg-white p-5 rounded-4 shadow-sm border">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fs-2 fw-bold text-{{ $task ? 'primary' : 'success' }}">
                        {{ $task ? 'Update Task' : 'Create Task' }}
                    </h3>

                    <a wire:navigate href="{{ route('tasks.board') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle me-2"></i>
                        Back to Tasks
                    </a>
                </div>

                <form wire:submit.prevent="save">

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-3" id="title" wire:model="title"
                            placeholder="Task Title">
                        <label for="title">Task Title</label>
                        @error('title')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control rounded-3" id="description" wire:model="description" placeholder="Description"
                            style="height: 110px"></textarea>
                        <label for="description">Description</label>
                        @error('description')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select rounded-3" id="status" wire:model="status">
                            <option value="">Select Status</option>
                            @foreach ($statusOptions as $statusOption)
                                <option value="{{ $statusOption['value'] }}">
                                    {{ $statusOption['label'] }}
                                </option>
                            @endforeach
                        </select>
                        <label for="status">Status</label>
                        @error('status')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select rounded-3" id="priority" wire:model="priority">
                            <option value="">Select Priority</option>
                            @foreach ($priorityOptions as $priorityOption)
                                <option value="{{ $priorityOption['value'] }}">
                                    {{ ucfirst($priorityOption['value']) }}
                                </option>
                            @endforeach
                        </select>
                        <label for="priority">Priority</label>
                        @error('priority')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="date" class="form-control rounded-3" id="due_date" wire:model="due_date"
                            placeholder="Due Date">
                        <label for="due_date">Due Date</label>
                        @error('due_date')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select rounded-3" id="project_id" wire:model="project_id">
                            <option value="">Select Project</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">
                                    {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                        <label for="project_id">Project</label>
                        @error('project_id')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-4">
                        <select class="form-select rounded-3" id="assigned_to" wire:model="assigned_to">
                            <option value="">Select User</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        <label for="assigned_to">Assign User</label>
                        @error('assigned_to')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit"
                        class="btn btn-{{ $task ? 'primary' : 'success' }} w-100 py-2 rounded-pill fw-semibold"
                        wire:loading.attr="disabled" wire:target="save">

                        <span wire:loading wire:target="save" class="spinner-border spinner-border-sm me-2"></span>

                        <span wire:loading.remove wire:target="save">
                            {{ $task ? 'Update Task' : 'Create Task' }}
                        </span>
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>
