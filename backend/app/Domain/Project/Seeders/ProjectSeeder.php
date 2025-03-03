<?php

namespace App\Domain\Project\Seeders;

use Illuminate\Database\Seeder;
use App\Domain\Project\Models\Project;
use App\Domain\Project\Factories\TimeTrackFactory;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::query()->delete();
        TimeTrackFactory::factory()->count(10)->create();
    }
}
