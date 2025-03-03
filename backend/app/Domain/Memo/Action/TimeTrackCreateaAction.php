<?php
namespace App\Domain\Memo\Action;

use App\Domain\Memo\Models\TimeTrack;
use App\Domain\Memo\DataTransferObjects\Action\TimeTrackCreateDto;

class TimeTrackCreateaAction
{
    public function __invoke(TimeTrackCreateDto $dto)
    {
        return TimeTrack::create([
            'project_id' => $dto->project_id,
            'start' => $dto->start,
            'finish' => $dto->finish,
            'memo' => $dto->memo,
        ]);
    }
}
