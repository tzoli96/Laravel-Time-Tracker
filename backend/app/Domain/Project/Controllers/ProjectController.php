<?php
namespace App\Domain\Project\Controllers;

use App\Domain\Project\Requests\ProjectStoreRequest;
use App\Domain\Project\Service\ProjectService;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function __construct(private readonly ProjectService $service) {}


    public function store(ProjectStoreRequest $request)
    {
        $dto = $this->service->store($request->toDto());

        return response()->json([
            'message' => 'Project created successfully',
            'data' => $dto
        ], 201);
    }
}
