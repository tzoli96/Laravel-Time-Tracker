<?php
namespace App\Domain\Memo\Controllers;

use App\Http\Controllers\Controller;
use App\Domain\Memo\Requests\TimeTrackStoreRequest;
use App\Domain\Memo\Requests\AutoSaveMemo;
use App\Domain\Memo\Service\TimeTrackService;
use Illuminate\Http\JsonResponse;

class TimeTrackController extends Controller
{
    public function __construct(private readonly TimeTrackService $service) {}

    public function store(TimeTrackStoreRequest $request): JsonResponse
    {
        $timeTrack = $this->service->create($request->toDto());

        return response()->json([
            'message' => 'Time track added successfully',
            'data' => $timeTrack
        ], 201);
    }

    public function autosave(AutoSaveMemo $request): JsonResponse
    {
        $memo = Memo::updateOrCreate(
            ['id' => $request->validated('memo_id')],
            [
                'project_id' => $request->validated('project_id'),
                'content' => $request->validated('content'),
                'status' => 'draft',
            ]
        );

        return response()->json([
            'message' => 'Memo autosaved successfully',
            'data' => $memo
        ]);
    }
}
