<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Component;

class ProjectIndex extends Component
{
    public $projects;

    public function mount()
    {
        $this->loadProjects();
    }

    public function loadProjects()
    {
        $this->projects = Project::with('user', 'tasks')->get();
    }

    #[On('refreshList')]
    public function refreshList()
    {
        $this->loadProjects();
    }

    #[On('delete-project')]
    public function deleteProject($id)
    {
        $project = Project::findOrFail($id);

        if ($project->tasks()->exists()) {
            $this->dispatch('toast', [
                'type' => 'error',
                'message' => 'Cannot delete project with tasks!',
            ]);

            return;
        }

        $project->delete();

        $this->dispatch('toast', [
            'type' => 'success',
            'message' => 'Project deleted successfully!',
        ]);
        $this->loadProjects();
    }

    public function render()
    {
        return view('livewire.projects.project-index');
    }
}
