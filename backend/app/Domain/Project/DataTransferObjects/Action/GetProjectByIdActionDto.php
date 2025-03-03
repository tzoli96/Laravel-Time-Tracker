<?php
namespace App\Domain\Project\DataTransferObjects\Action;

use App\Domain\Project\DataTransferObjects\Service\ProjectGetRequestDto;

class GetProjectByIdActionDto
{
    public string $project_id;

    public static function fromData(ProjectGetRequestDto $data): self
    {
        $dto = new self();
        $dto->project_id = $data->project_id;
        return $dto;
    }
}
