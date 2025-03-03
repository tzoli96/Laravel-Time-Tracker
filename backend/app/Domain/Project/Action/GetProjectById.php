<?php

namespace App\Domain\Project\Action;

use App\Domain\Project\Models\Project;
use App\Domain\Project\DataTransferObjects\Action\GetProjectByIdActionDto;

class GetProjectById
{
    public function __invoke(GetProjectByIdActionDto $dto): Project
    {
        return Project::with('timeTracks')->findOrFail($dto->project_id);
    }
}
