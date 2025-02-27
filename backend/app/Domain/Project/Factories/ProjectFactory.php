<?php

namespace App\Domain\Project\Factories;

use App\Domain\Project\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'project_name' => $this->faker->name(),
        ];
    }
}
