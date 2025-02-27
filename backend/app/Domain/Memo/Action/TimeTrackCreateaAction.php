<?php
namespace App\Domain\Memo\Action;

class TimeTrackCreateaAction
{

    public function __invoke()
    {
        TimeTrack::create([
            'project_id' => $project_id,
            'start' => $request->start,
            'finish' => $request->finish,
            'memo' => $request->memo,
        ]);
    }
}
