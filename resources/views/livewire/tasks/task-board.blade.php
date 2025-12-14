<div>
    <div>
        <h2 class="text-xl font-bold mb-4">Tasks</h2>
        <div class="grid grid-cols-3 gap-4">
            @foreach (['todo', 'in_progress', 'done'] as $status)
                <div>
                    <h3 class="font-semibold capitalize">{{ $status }}</h3>
                    @foreach ($tasks->where('status', $status) as $task)
                        <div class="border p-2 mb-2">
                            <div>{{ $task->title }}</div>
                            <div class="text-xs text-gray-500">{{ $task->project->name }}</div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

</div>
