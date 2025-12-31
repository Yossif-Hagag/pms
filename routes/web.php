<?php

use App\Livewire\Projects\ProjectForm;
use App\Livewire\Projects\ProjectIndex;
use App\Livewire\Projects\ProjectView;
use App\Livewire\Tasks\TaskBoard;
use App\Livewire\Tasks\TaskForm;
use App\Livewire\Tasks\TaskView;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::view('dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::view('profile', 'profile')->name('profile');

    Route::get('/projects', ProjectIndex::class)->name('projects.index');
    Route::get('/projects/create', ProjectForm::class)->name('projects.create');
    Route::get('/projects/{project}/edit', ProjectForm::class)->name('projects.edit');
    Route::get('/projects/{project}', ProjectView::class)->name('projects.view');

    Route::get('/tasks', TaskBoard::class)->name('tasks.board');
    Route::get('/tasks/create', TaskForm::class)->name('tasks.create');
    Route::get('/tasks/{task}/edit', TaskForm::class)->name('tasks.edit');
    Route::get('/tasks/{task}', TaskView::class)->name('tasks.view');
});

require __DIR__.'/auth.php';
