<?php
namespace App\Domain\Project\DataTransferObjects\Service;

class ProjectStoreRequestDto
{
    public function __construct(
        public readonly string $project_name
    ) {}

    public static function fromRequest(string $project_name): self
    {
        return new self(
            project_name: $project_name
        );
    }
}
