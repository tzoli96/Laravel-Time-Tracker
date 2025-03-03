<?php
namespace App\Domain\Project\DataTransferObjects\Service;

class ProjectGetRequestDto
{
    public function __construct(
        public readonly string $project_id
    ) {}

    public static function fromRequest(string $project_id): self
    {
        return new self(
            project_id: $project_id
        );
    }
}
