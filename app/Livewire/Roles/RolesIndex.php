<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class RolesIndex extends Component
{
    public function render()
    {
        return view('livewire.roles.index', [
            'roles' => Role::with('permissions')->get(),
        ]);
    }
}
