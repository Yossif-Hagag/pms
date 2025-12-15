<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body">

            @if (session()->has('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <h2 class="card-title mb-4">{{ $task ? 'Edit Task' : 'Create Task' }}</h2>

            <form wire:submit.prevent="save">
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" wire:model.defer="title" class="form-control">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea wire:model.defer="description" class="form-control" rows="4"></textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Status</label>
                        <select wire:model.defer="status" class="form-select">
                            @foreach ($statusOptions as $statusOption)
                                <option value="{{ $statusOption['value'] }}">{{ $statusOption['label'] }}</option>
                            @endforeach
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col">
                        <label class="form-label">Priority</label>
                        <select wire:model.defer="priority" class="form-select">
                            @foreach ($priorityOptions as $priorityOption)
                                <option value="{{ $priorityOption['value'] }}">{{ ucfirst($priorityOption['value']) }}
                                </option>
                            @endforeach
                        </select>
                        @error('priority')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Project</label>
                        <select wire:model.defer="project_id" class="form-select">
                            <option value="">Select Project</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                        @error('project_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col">
                        <label class="form-label">Assign User</label>
                        <select wire:model.defer="assigned_to" class="form-select">
                            <option value="">Select User</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('assigned_to')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">{{ $task ? 'Update Task' : 'Create Task' }}</button>
                </div>
            </form>

        </div>
    </div>
</div>
