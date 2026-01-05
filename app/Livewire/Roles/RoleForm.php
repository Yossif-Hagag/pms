<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleForm extends Component
{
    public ?Role $role = null;

    public string $name = '';

    public array $selectedPermissions = [];

    public function mount(?Role $role = null)
    {
        if ($role) {
            $this->role = $role;
            $this->name = $role->name;
            $this->selectedPermissions = $role->permissions->pluck('name')->toArray();
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|unique:roles,name,'.($this->role->id ?? 'null'),
            'selectedPermissions' => 'array',
        ]);

        $role = $this->role
            ? tap($this->role)->update(['name' => $this->name])
            : Role::create(['name' => $this->name]);

        $role->syncPermissions($this->selectedPermissions);

        return redirect()->route('roles.index')
            ->with('success', 'Role saved successfully');
    }

    public function render()
    {
        return view('livewire.roles.form', [
            'permissions' => Permission::all(),
        ]);
    }
}
