<?php

use App\Livewire\Projects\ProjectForm;
use App\Livewire\Projects\ProjectIndex;
use App\Livewire\Projects\ProjectView;
use App\Livewire\Roles\RolesIndex;
use App\Livewire\Tasks\TaskBoard;
use App\Livewire\Tasks\TaskForm;
use App\Livewire\Tasks\TaskView;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::view('dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->prefix('/dashboard')->group(function () {
    Route::view('profile', 'profile')->name('profile');

    Route::get('/roles', RolesIndex::class)->name('roles.index')->middleware('role:admin');

    Route::get('/projects', ProjectIndex::class)->name('projects.index');
    Route::get('/projects/create', ProjectForm::class)->name('projects.create')->middleware('permission:create project');
    Route::get('/projects/{project}/edit', ProjectForm::class)->name('projects.edit')->middleware('permission:edit project');
    Route::get('/projects/{project}', ProjectView::class)->name('projects.view')->middleware('permission:view project');

    Route::get('/tasks', TaskBoard::class)->name('tasks.board');
    Route::get('/tasks/create', TaskForm::class)->name('tasks.create')->middleware('permission:create task');
    Route::get('/tasks/{task}/edit', TaskForm::class)->name('tasks.edit')->middleware('permission:edit task');
    Route::get('/tasks/{task}', TaskView::class)->name('tasks.view')->middleware('permission:view task');
});

require __DIR__.'/auth.php';
