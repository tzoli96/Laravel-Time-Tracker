<?php
namespace App\Domain\Project\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Domain\Project\DataTransferObjects\Service\ProjectGetRequestDto;
use Illuminate\Validation\Rule;

class ProjectGetRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'project_id' => $this->route('project_id'),
        ]);
    }

    public function rules(): array
    {
        return [
            'project_id' => [
                'required',
                'integer',
                Rule::exists('projects', 'id'),
            ],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function toDto(): ProjectGetRequestDto
    {
        return ProjectGetRequestDto::fromRequest($this->validated('project_id'));
    }
}
