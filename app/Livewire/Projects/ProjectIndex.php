<?php

namespace App\Livewire\Projects;

use App\Models\Project;
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

    public function delete(Project $project)
    {
        if ($project->tasks()->count() > 0) {
            return back()->with('error', 'Cannot delete project with tasks!');
        }
        $project->delete();
        session()->flash('message', 'Project deleted successfully!');
        $this->loadProjects();
    }

    public function render()
    {
        return view('livewire.projects.project-index');
    }
}
