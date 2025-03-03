<?php
namespace App\Domain\Memo\Controllers;

use App\Http\Controllers\Controller;
use App\Domain\Memo\Requests\TimeTrackStoreRequest;
use App\Domain\Memo\Service\TimeTrackService;

class TimeTrackController extends Controller
{
    public function __construct(private readonly TimeTrackService $service) {}

    public function store(TimeTrackStoreRequest $request)
    {
        $timeTrack = $this->service->create($request->toDto());

        return response()->json([
            'message' => 'Time track added successfully',
            'data' => $timeTrack
        ], 201);
    }
}
