<?php
use App\Domain\Project\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
Route::post('/projects/{project_id}/time-tracks', [TimeTrackController::class, 'store']);
