<?php

use App\Domain\Project\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\postJson;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

it('creates a project successfully', function () {
    $response = postJson(route('projects.store'), [
        'project_name' => 'New Project',
    ]);

    $response->assertCreated()
        ->assertJson([
            'message' => 'Project created successfully',
            'data' => [
                'project_name' => 'New Project',
            ],
        ]);

    expect(Project::where('project_name', 'New Project')->exists())->toBeTrue();
});

it('fails if project_name is missing', function () {
    $response = postJson(route('projects.store'), []);

    $response->assertUnprocessable()
        ->assertJsonValidationErrors(['project_name']);
});

it('fails if project_name already exists', function () {
    Project::factory()->create(['project_name' => 'Duplicate Project']);

    $response = postJson(route('projects.store'), [
        'project_name' => 'Duplicate Project',
    ]);

    $response->assertUnprocessable()
        ->assertJsonValidationErrors(['project_name']);
});
