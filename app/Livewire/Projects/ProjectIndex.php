<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $perPage = 8;

    #[On('refreshList')]

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
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.projects.project-index', [
            'projects' => Project::with('user', 'tasks')->paginate($this->perPage),
        ]);
    }
}
