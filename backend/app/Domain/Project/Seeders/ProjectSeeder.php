<?php

namespace App\Domain\Project\Seeders;

use Illuminate\Database\Seeder;
use App\Domain\Project\Models\Project;
use App\Domain\Project\Factories\ProjectFactory;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::query()->delete();
        ProjectFactory::factory()->count(10)->create();
    }
}
