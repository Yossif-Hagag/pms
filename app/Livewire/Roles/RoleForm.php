<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * @property \Spatie\Permission\Models\Role|null $role
 */
class RoleForm extends Component
{
    public ?Role $role = null;

    public string $name = '';

    public array $selectedPermissions = [];

    public $permissions;

    public function mount(?Role $role = null)
    {
        $this->permissions = Permission::all();

        if ($role) {
            $this->role = $role;
            $this->name = $role->name;
            $this->selectedPermissions = $role->permissions->pluck('name')->toArray();
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:roles,name,'.($this->role->id ?? 'null'),
            'selectedPermissions' => 'array',
        ]);

        if ($this->role) {
            $this->role->update(['name' => $this->name]);
            $role = $this->role;
        } else {
            $role = Role::create(['name' => $this->name]);
        }

        $role->syncPermissions($this->selectedPermissions);

        $this->dispatch('store-toast', [
            'type' => 'success',
            'message' => 'Role saved successfully!',
        ]);

        $this->redirect(route('roles.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.roles.form', [
            'permissions' => $this->permissions,
        ]);
    }
}
