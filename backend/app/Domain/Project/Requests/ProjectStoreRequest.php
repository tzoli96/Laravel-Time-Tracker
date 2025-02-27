<?php
namespace App\Domain\Project\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Domain\Project\DataTransferObjects\Service\ProjectStoreRequestDto;

class ProjectStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'project_name' => 'required|string|unique:projects,project_name',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function toDto(): ProjectStoreRequestDto
    {
        return ProjectStoreRequestDto::fromRequest($this->validated('project_name'));
    }
}
