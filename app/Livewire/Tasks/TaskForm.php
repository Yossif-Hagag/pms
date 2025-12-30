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
    public ?Task $task = null;

    public ?string $title = null;

    public ?string $description = null;

    public ?string $status = null;

    public ?string $priority = null;

    public ?string $due_date = null;

    public ?int $project_id = null;

    public ?int $assigned_to = null;

    public $projects;

    public $users;

    public function mount(?Task $task = null)
    {
        $this->projects = Project::all();
        $this->users = User::all();

        if ($task) {
            $this->task = $task;
            $this->title = $task->title;
            $this->status = $task->status->value;
            $this->priority = $task->priority->value;
            $this->description = $task->description;
            $this->due_date = $task->due_date?->format('Y-m-d');
            $this->project_id = $task->project_id;
            $this->assigned_to = $task->assigned_to;
        } else {
            $this->status = TaskStatus::Todo->value;
            $this->priority = TaskPriority::Low->value;
            $this->due_date = now()->format('Y-m-d');
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

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'status' => TaskStatus::from($this->status),
            'priority' => TaskPriority::from($this->priority),
            'due_date' => $this->due_date,
            'project_id' => $this->project_id,
            'assigned_to' => $this->assigned_to,
        ];

        if ($this->task) {
            $this->task->update($data);
        } else {
            $task = Task::create($data);
        }

        $this->dispatch('store-toast', [
            'type' => 'success',
            'message' => 'Task saved successfully!',
        ]);

        $this->redirect(route('tasks.board'), navigate: true);
    }

    public function render()
    {
        return view('livewire.tasks.task-form', [
            'statusOptions' => TaskStatus::options(),
            'priorityOptions' => TaskPriority::options(),
        ]);
    }
}
