<?php

use App\Domain\Memo\Models\TimeTrack;
use App\Domain\Project\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\{postJson,getJson};
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

it('returns a list of all projects', function () {
    Project::factory()->count(3)->create();
    $response = $this->getJson(route('projects.index'));
    $response->assertStatus(200)
        ->assertJsonStructure([
            'message',
            'data' => [
                '*' => [
                    'id',
                    'project_name',
                    'created_at',
                    'updated_at'
                ]
            ]
        ]);
});

it('returns an empty array when no projects exist', function () {
    $response = $this->getJson(route('projects.index'));

    $response->assertStatus(200)
        ->assertJson([
            'message' => 'Projects retrieved successfully',
            'data' => []
        ]);
});

it('retrieves a specific project successfully with time tracks', function () {
    $project = Project::factory()->create([
        'project_name' => 'Test Project'
    ]);

    TimeTrack::factory()->count(3)->create([
        'project_id' => $project->id,
    ]);

    $response = getJson(route('project.get', ['project_id' => $project->id]));

    $response->assertStatus(201);
});
