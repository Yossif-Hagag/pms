<div class="max-w-xl mx-auto p-6 bg-white shadow rounded">

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
            {{ session('message') }}
        </div>
    @endif

    <h2 class="text-xl font-bold mb-4">
        {{ $task ? 'Edit Task' : 'Create Task' }}
    </h2>

    <form wire:submit.prevent="save">

        {{-- Title --}}
        <div class="mb-4">
            <label class="block font-medium mb-1">Title</label>
            <input type="text" wire:model.defer="title" class="border p-2 w-full rounded">
            @error('title')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Description --}}
        <div class="mb-4">
            <label class="block font-medium mb-1">Description</label>
            <textarea wire:model.defer="description" class="border p-2 w-full rounded" rows="4"></textarea>
            @error('description')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Status --}}
        <div class="mb-4">
            <label class="block font-medium mb-1">Status</label>
            <select wire:model.defer="status" class="border p-2 w-full rounded">
                <option value="">Select Status</option>
                @foreach ($statusOptions as $statusOption)
                    <option value="{{ $statusOption }}">{{ ucfirst(str_replace('_', ' ', $statusOption)) }}</option>
                @endforeach
            </select>
            @error('status')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Priority --}}
        <div class="mb-4">
            <label class="block font-medium mb-1">Priority</label>
            <select wire:model.defer="priority" class="border p-2 w-full rounded">
                <option value="">Select Priority</option>
                @foreach ($priorityOptions as $priorityOption)
                    <option value="{{ $priorityOption }}">{{ ucfirst($priorityOption) }}</option>
                @endforeach
            </select>
            @error('priority')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Project --}}
        <div class="mb-4">
            <label class="block font-medium mb-1">Project</label>
            <select wire:model.defer="project_id" class="border p-2 w-full rounded">
                <option value="">Select Project</option>
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                @endforeach
            </select>
            @error('project_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Assigned User --}}
        <div class="mb-4">
            <label class="block font-medium mb-1">Assign To</label>
            <select wire:model.defer="assigned_to" class="border p-2 w-full rounded">
                <option value="">Select User</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('assigned_to')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Submit --}}
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                {{ $task ? 'Update Task' : 'Create Task' }}
            </button>
        </div>

    </form>
</div>
