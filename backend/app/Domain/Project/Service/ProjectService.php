<?php
namespace App\Domain\Project\Service;

use App\Domain\Project\DataTransferObjects\Service\ProjectStoreRequestDto;
use App\Domain\Project\DataTransferObjects\Service\ProjectGetRequestDto;
use App\Domain\Project\DataTransferObjects\Action\CreateProjectActionDto;
use App\Domain\Project\DataTransferObjects\Action\GetProjectByIdActionDto;
use App\Domain\Project\Action\CreateAProjectAction;
use App\Domain\Project\Action\GetAllProjectAction;
use App\Domain\Project\Action\GetProjectById;

class ProjectService
{
    public function store(ProjectStoreRequestDto $serviceParamDto)
    {
        $dto = CreateProjectActionDto::fromData($serviceParamDto);
        return app(CreateAProjectAction::class)($dto);
    }

    public function getAllProjects()
    {
        return app(GetAllProjectAction::class)();
    }

    public function getProjectById(ProjectGetRequestDto $requestDto)
    {
        $dto = GetProjectByIdActionDto::fromData($requestDto);
        return app(GetProjectById::class)($dto);
    }
}
