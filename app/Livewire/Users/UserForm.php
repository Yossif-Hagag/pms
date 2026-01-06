<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserForm extends Component
{
    public ?User $user = null;

    public string $name = '';

    public string $email = '';

    public ?string $password = null;

    public ?string $password_confirmation = null;

    public ?string $role = null;

    public function mount(?User $user = null)
    {
        if ($user) {
            $this->user = $user;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->role = $user->roles->pluck('name')->first();
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.($this->user->id ?? 'null'),
            'password' => $this->user ? 'nullable|string|min:6|confirmed' : 'required|string|min:6|confirmed',
            'password_confirmation' => 'nullable|string|min:6',
            'role' => 'required|string|exists:roles,name',
        ]);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        $user = $this->user
            ? tap($this->user)->update($data)
            : $user = User::create($data);

        $user->syncRoles([$this->role]);

        $this->dispatch('toast', [
            'type' => 'success',
            'message' => 'User saved successfully!',
        ]);

        $this->redirect(route('users.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.users.form', [
            'allRoles' => Role::all(),
        ]);
    }
}
