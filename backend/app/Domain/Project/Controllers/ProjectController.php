<?php
namespace App\Domain\Project\Controllers;

use App\Domain\Project\Requests\ProjectStoreRequest;
use App\Domain\Project\Requests\ProjectGetRequest;
use App\Domain\Project\Service\ProjectService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    public function __construct(private readonly ProjectService $service) {}

    public function index(): JsonResponse
    {
        $projects = $this->service->getAllProjects();

        return response()->json([
            'message' => 'Projects retrieved successfully',
            'data' => $projects
        ]);
    }

    public function store(ProjectStoreRequest $request): JsonResponse
    {
        $dto = $this->service->store($request->toDto());

        return response()->json([
            'message' => 'Project created successfully',
            'data' => $dto
        ], 201);
    }

    public function get(ProjectGetRequest $request): JsonResponse
    {
        $dto = $this->service->getProjectById($request->toDto());

        return response()->json([
            'message' => 'Project created successfully',
            'data' => $dto
        ], 201);
    }
}
