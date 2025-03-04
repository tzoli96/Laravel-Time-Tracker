<?php

namespace App\Domain\Memo\DataTransferObjects\Action;

use App\Domain\Memo\DataTransferObjects\Service\TimeTrackStoreRequestDto;

class TimeTrackCreateDto
{
    public function __construct(
        public int $project_id,
        public string $start,
        public ?string $finish,
        public ?string $memo,
        public ?string $status
    ) {}

    public static function fromData(TimeTrackStoreRequestDto $requestDto): self
    {
        return new self(
            $requestDto->project_id,
            $requestDto->start,
            $requestDto->finish ?? null,
            $requestDto->memo ?? null,
            $requestDto
        );
    }
}
