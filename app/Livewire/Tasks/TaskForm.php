<?php

namespace App\Livewire\Tasks;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Livewire\Component;

class TaskForm extends Component
{
    public $task;

    public $title;

    public $description;

    public $status;

    public $priority;

    public $due_date;

    public $project_id;

    public $assigned_to;

    public $projects;

    public $users;

    public function mount(?Task $task = null)
    {
        $this->projects = Project::all();
        $this->users = User::all();

        if ($task) {
            $this->task = $task;
            $this->title = $task->title;
            $this->description = $task->description;
            $this->status = $task->status;
            $this->priority = $task->priority;
            $this->due_date = $task->due_date;
            $this->project_id = $task->project_id;
            $this->assigned_to = $task->assigned_to;
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'status' => ['required', 'string', function ($attribute, $value, $fail) {
                $validStatuses = array_column(TaskStatus::options(), 'value');
                if (! in_array($value, $validStatuses)) {
                    $fail("The selected {$attribute} is invalid.");
                }
            }],

            'priority' => ['required', 'string', function ($attribute, $value, $fail) {
                $validPriorities = array_column(TaskPriority::options(), 'value');
                if (! in_array($value, $validPriorities)) {
                    $fail("The selected {$attribute} is invalid.");
                }
            }],
            'project_id' => 'required|exists:projects,id',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        if ($this->task) {
            $this->task->update([
                'title' => $this->title,
                'description' => $this->description,
                'status' => $this->status,
                'priority' => $this->priority,
                'due_date' => $this->due_date,
                'project_id' => $this->project_id,
                'assigned_to' => $this->assigned_to,
            ]);
        } else {
            Task::create([
                'title' => $this->title,
                'description' => $this->description,
                'status' => $this->status,
                'priority' => $this->priority,
                'due_date' => $this->due_date,
                'project_id' => $this->project_id,
                'assigned_to' => $this->assigned_to,
            ]);
        }

        session()->flash('message', 'Task saved!');

        return redirect()->route('tasks.board');
    }

    public function render()
    {
        return view('livewire.tasks.task-form', [
            'statusOptions' => TaskStatus::options(),
            'priorityOptions' => TaskPriority::options(),
        ]);
    }
}
