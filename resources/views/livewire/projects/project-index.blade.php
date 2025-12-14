<div>
    <div>
        <h1 class="text-xl font-bold mb-4">Projects</h1>
        <ul>
            @foreach ($projects as $project)
                <li class="p-2 border-b flex justify-between items-center">
                    <span>{{ $project->name }} ({{ $project->status }})</span>
                    @can('edit project')
                        <button class="text-blue-500">Edit</button>
                    @endcan
                </li>
            @endforeach
        </ul>
    </div>

</div>
