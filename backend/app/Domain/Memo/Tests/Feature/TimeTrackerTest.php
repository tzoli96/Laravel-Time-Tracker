<?php

use Tests\TestCase;
use App\Domain\Project\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\postJson;

uses(TestCase::class, RefreshDatabase::class);

it('creates a time track successfully', function () {
    $project = Project::factory()->create();
    $payload = [
        'start' => now()->subHours(2)->toISOString(),
        'finish' => now()->toISOString(),
        'memo' => 'Worked on project API',
    ];

    $response = postJson(route('timetrack.store', ['project_id' => $project->id]), $payload);
    $response->assertStatus(201);
    $response->assertJson([
        'message' => 'Time track added successfully',
    ]);

    $response->assertJsonPath('data.project_id', $project->id);
    $response->assertJsonPath('data.memo', $payload['memo']);

    $this->assertDatabaseHas('time_tracks', [
        'project_id' => $project->id,
        'memo' => 'Worked on project API',
    ]);
});

it('fails when project_id does not exist', function () {
    $response = postJson(route('timetrack.store', ['project_id' => 99999]), [
        'start' => now()->subHours(2)->toISOString(),
        'finish' => now()->toISOString(),
        'memo' => 'Invalid project',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['project_id']);
});

it('fails when start is missing', function () {
    $project = Project::factory()->create();

    $response = postJson(route('timetrack.store', ['project_id' => $project->id]), [
        'finish' => now()->toISOString(),
        'memo' => 'Missing start time',
    ]);

    // Assert: Validation should fail
    $response->assertStatus(422)
        ->assertJsonValidationErrors(['start']);
});

it('fails when finish is before start', function () {
    $project = Project::factory()->create();
    $response = postJson(route('timetrack.store', ['project_id' => $project->id]), [
        'start' => now()->toISOString(),
        'finish' => now()->subHours(1)->toISOString(),
        'memo' => 'Invalid date order',
    ]);

    // Assert: Validation should fail
    $response->assertStatus(422)
        ->assertJsonValidationErrors(['finish']);
});
