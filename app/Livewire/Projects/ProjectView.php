<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Livewire\Component;

class ProjectView extends Component
{
    public Project $project;

    public function mount(Project $project)
    {
        $this->project = $project->load('user', 'tasks');
    }

    public function render()
    {
        return view('livewire.projects.project-view');
    }
}
