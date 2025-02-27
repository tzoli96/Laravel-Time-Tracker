<?php

namespace App\Domain\Memo\DataTransferObjects\Service;

class TimeTrackStoreRequestDto
{
    public function __construct(
        public int $project_id,
        public string $start,
        public ?string $finish,
        public ?string $memo
    ) {}

    public static function fromRequest(array $validatedData, int $project_id): self
    {
        return new self(
            $project_id,
            $validatedData['start'],
            $validatedData['finish'] ?? null,
            $validatedData['memo'] ?? null
        );
    }
}
