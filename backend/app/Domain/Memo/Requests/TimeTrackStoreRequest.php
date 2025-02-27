<?php

namespace App\Domain\Memo\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Domain\Memo\DataTransferObjects\Service\TimeTrackStoreRequestDto;

class TimeTrackStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'project_id' => [
                'required',
                'integer',
                Rule::exists('projects', 'id')
            ],
            'start' => 'required|date',
            'finish' => 'nullable|date|after:start',
            'memo' => 'nullable|string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Add `project_id` from the route to the validated data.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'project_id' => $this->route('project_id'),
        ]);
    }

    /**
     * Convert request data into a DTO.
     */
    public function toDto(): TimeTrackStoreRequestDto
    {
        return new TimeTrackStoreRequestDto(
            $this->validated('project_id'),
            $this->validated('start'),
            $this->validated('finish'),
            $this->validated('memo')
        );
    }
}
