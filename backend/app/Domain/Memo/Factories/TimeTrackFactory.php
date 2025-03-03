<?php

namespace App\Domain\Memo\Factories;

use App\Domain\Memo\Models\TimeTrack;
use App\Domain\Project\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimeTrackFactory extends Factory
{
    protected $model = TimeTrack::class;

    public function definition(): array
    {
        $startTime = $this->faker->dateTimeBetween('-1 week', 'now');
        $finishTime = $this->faker->optional()->dateTimeBetween($startTime, 'now');

        return [
            'project_id' => Project::factory(),
            'start' => $startTime,
            'finish' => $finishTime,
            'duration' => $finishTime ? $finishTime->getTimestamp() - $startTime->getTimestamp() : null,
            'memo' => $this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
