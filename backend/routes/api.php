<?php
use App\Domain\Project\Controllers\ProjectController;
use App\Domain\Memo\Controllers\TimeTrackController;
use Illuminate\Support\Facades\Route;

Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::post('/projects/{project_id}/time-tracks', [TimeTrackController::class, 'store'])->name('timetrack.store');
Route::get('/projects/{project_id}', [ProjectController::class, 'get'])->name('project.get');
