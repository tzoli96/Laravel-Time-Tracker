<?php

namespace App\Domain\Memo\Service;

use App\Domain\Memo\Action\TimeTrackCreateaAction;
use App\Domain\Memo\DataTransferObjects\Action\TimeTrackCreateDto;
use App\Domain\Memo\DataTransferObjects\Service\TimeTrackStoreRequestDto;

class TimeTrackService
{
    public function create(TimeTrackStoreRequestDto $dto)
    {
        $dto = TimeTrackCreateDto::fromData($dto);
        return app(TimeTrackCreateaAction::class)($dto);
    }
}
