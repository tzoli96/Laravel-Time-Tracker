<?php

namespace App\Domain\Project\Action;

use App\Domain\Project\Models\Project;
use App\Domain\Project\DataTransferObjects\Action\CreateProjectActionDto;

class CreateAProjectAction
{
    public function __invoke(CreateProjectActionDto $createProjectActionDto)
    {
        $project = Project::firstOrCreate(
            ['project_name' => $createProjectActionDto->project_name]
        );

        return $project;
    }
}
