<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class TaskBoard extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    #[On('refreshList')]

    #[On('delete-task')]
    public function deleteTask($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        $this->dispatch('toast', [
            'type' => 'success',
            'message' => 'Task deleted successfully!',
        ]);
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.tasks.task-board', [
            'tasks' => Task::with('project', 'assignedUser')->get(),
        ]);
    }
}
