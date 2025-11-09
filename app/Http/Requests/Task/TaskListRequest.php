<?php

namespace App\Http\Requests\Task;

use App\Domain\Task\DTO\Request\TaskFilterRequestData;
use App\Domain\Task\Enum\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\WithData;

class TaskListRequest extends FormRequest
{
    use WithData;

    public function dataClass(): string
    {
        return TaskFilterRequestData::class;
    }

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
            'project' => ['required', 'string', 'exists:tasks,project'],
            'dueDate' => ['date_format:Y-m-d H:i:s'],
            'executor' => ['integer', 'exists:users,id'],
            'status' => [Rule::enum(StatusEnum::class)],
        ];
    }

    public function validationData(): array
    {
        return array_merge($this->all(), $this->route()->parameters());
    }

    public function getData(): TaskFilterRequestData
    {
        return TaskFilterRequestData::from([
            ...$this->all(),
            'project' => $this->route()->parameter('project'),
        ]);
    }
}
