<?php
namespace App\Domain\Project\Service;

use App\Domain\Project\DataTransferObjects\Service\ProjectStoreRequestDto;
use App\Domain\Project\DataTransferObjects\Action\CreateProjectActionDto;
use App\Domain\Project\Action\CreateAProjectAction;

class ProjectService
{
    public function store(ProjectStoreRequestDto $serviceParamDto)
    {
        $dto = CreateProjectActionDto::fromData($serviceParamDto);
        return app(CreateAProjectAction::class)($dto);
    }
}
