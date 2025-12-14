<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Livewire\Component;

class ProjectIndex extends Component
{
    public $projects;

    public function mount()
    {
        $this->projects = Project::with('users')->get();
    }

    public function render()
    {
        return view('livewire.projects.project-index');
    }
}
