<?php

namespace App\Http\Requests\Task;

use App\Domain\Task\DTO\Request\TaskListRequestDto;
use App\Http\Requests\RequestInterface;
use Illuminate\Foundation\Http\FormRequest;

class TaskListRequest extends FormRequest implements RequestInterface
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'project' => ['required', 'string'],
        ];
    }

    public function validationData(): array
    {
        return array_merge($this->all(), $this->route()->parameters());
    }

    public function getDto(): TaskListRequestDto
    {
        $dto = new TaskListRequestDto();
        $dto->project = $this->route()->parameter('project');
        return $dto;
    }
}
