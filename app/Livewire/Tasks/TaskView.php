<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Livewire\Component;

class TaskView extends Component
{
    public Task $task;

    public function mount(Task $task)
    {
        $this->task = $task->load('project', 'assignedUser');
    }

    public function render()
    {
        return view('livewire.tasks.task-view');
    }
}
