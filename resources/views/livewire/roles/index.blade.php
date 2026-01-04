<div>
    <h2>Roles</h2>

    @foreach ($roles as $role)
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $role->name }}</h5>
                @foreach ($role->permissions as $permission)
                    <span class="badge bg-secondary">{{ $permission->name }}</span>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
