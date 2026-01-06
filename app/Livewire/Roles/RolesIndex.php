<?php

namespace App\Livewire\Roles;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RolesIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $perPage = 8;

    #[On('delete-role')]
    public function deleteRole($id)
    {
        $role = Role::findOrFail($id);

        if ($role->name === 'admin') {
            $this->dispatch('toast', [
                'type' => 'error',
                'message' => 'Cannot delete admin role!',
            ]);

            return;
        }

        $role->delete();

        $this->dispatch('toast', [
            'type' => 'success',
            'message' => 'Role deleted successfully!',
        ]);

        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.roles.index', [
            'roles' => Role::with('permissions')->paginate($this->perPage),
        ]);
    }
}
