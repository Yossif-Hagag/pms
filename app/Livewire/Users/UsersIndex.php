<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $perPage = 8;

    #[On('delete-user')]
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        // disable self-deletion
        if ($user->id === Auth::id()) {
            $this->dispatch('toast', [
                'type' => 'error',
                'message' => 'You cannot delete your own account!',
            ]);

            return;
        }

        $user->delete();

        $this->dispatch('toast', [
            'type' => 'success',
            'message' => 'User deleted successfully!',
        ]);

        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.users.index', [
            'users' => User::with('roles')->latest()->paginate($this->perPage),
        ]);
    }
}
