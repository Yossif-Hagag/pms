<?php

namespace App\Livewire\Projects;

use App\Enums\ProjectStatus;
use App\Models\Project;
use App\Models\User;
use Livewire\Component;

class ProjectForm extends Component
{
    public ?Project $project = null;

    public string $name = '';

    public ?string $description = null;

    public ?string $status = null;

    public ?int $user_id = null;

    public $users;

    public function mount(?Project $project = null)
    {
        $this->users = User::all();

        if ($project) {
            $this->project = $project;
            $this->name = $project->name;
            $this->description = $project->description;
            $this->status = $project->status?->value ?? null;
            $this->user_id = $project->user_id;
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => ['required', 'string', function ($attr, $value, $fail) {
                if (! in_array($value, array_column(ProjectStatus::options(), 'value'))) {
                    $fail("The selected {$attr} is invalid.");
                }
            }],
            'user_id' => 'required|exists:users,id',
        ]);

        $statusEnum = ProjectStatus::from($this->status);

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'status' => $statusEnum,
            'user_id' => $this->user_id,
        ];

        if ($this->project) {
            $this->project->update($data);
        } else {
            $this->project = Project::create($data);
        }

        $this->dispatch('toast', [
            'type' => 'success',
            'message' => 'Project saved successfully!',
        ]);

        // $this->redirect(
        //     route('projects.index'),
        //     navigate: true
        // );
        $this->emitTo('projects.project-index', 'refreshList');
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->project = null;
        $this->name = '';
        $this->description = null;
        $this->status = null;
        $this->user_id = null;
    }

    public function render()
    {
        return view('livewire.projects.project-form', [
            'users' => $this->users,
            'statuses' => ProjectStatus::options(),
        ]);
    }
}
