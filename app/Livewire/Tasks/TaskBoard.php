<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Livewire\Component;

class TaskBoard extends Component
{
    public $tasks;

    public function mount()
    {
        $this->tasks = Task::with('project', 'assignedUser')->get();
    }

    public function render()
    {
        return view('livewire.tasks.task-board');
    }
}
