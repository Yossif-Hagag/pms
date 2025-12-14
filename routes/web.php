<?php

use App\Livewire\Projects\ProjectForm;
use App\Livewire\Projects\ProjectIndex;
use App\Livewire\Tasks\TaskBoard;
use App\Livewire\Tasks\TaskForm;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/projects', ProjectIndex::class)->name('projects.index');
    Route::get('/projects/create', ProjectForm::class)->name('projects.create');
    Route::get('/projects/{project}/edit', ProjectForm::class)->name('projects.edit');

    Route::get('/tasks', TaskBoard::class)->name('tasks.board');
    Route::get('/tasks/create', TaskForm::class)->name('tasks.create');
    Route::get('/tasks/{task}/edit', TaskForm::class)->name('tasks.edit');
});
