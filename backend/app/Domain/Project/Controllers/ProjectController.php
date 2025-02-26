<?php
namespace App\Domain\Project\Controllers;

use App\Domain\Project\Models;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Domain\Project\Requests\ProjectStoreRequest;
use App\Domain\Project\Service\ProjectService;

class ProjectController extends Controller
{
    public function __construct(private readonly ProjectService $service) {}


    public function store(ProjectStoreRequest $request)
    {
        $dto = $this->service->store($request->toDto());
        $project = Project::create([
            'project_name' => $request->project_name,
        ]);

        return response()->json([
            'message' => 'Project created successfully',
            'data' => $dto
        ], 201);
    }
}
