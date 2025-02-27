<?php
namespace App\Domain\Project\DataTransferObjects\Action;

use App\Domain\Project\DataTransferObjects\Service\ProjectStoreRequestDto;
class CreateProjectActionDto
{
    public string $project_name;

    public static function fromData(ProjectStoreRequestDto $data): self
    {
        $dto = new self();
        $dto->project_name = $data->project_name;
        return $dto;
    }
}
