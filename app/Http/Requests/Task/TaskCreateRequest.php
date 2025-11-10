<?php

namespace App\Http\Requests\Task;

use App\Domain\Task\DTO\Request\TaskCreateRequestData;
use App\Domain\Task\Enum\StatusEnum;
use DateTimeInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\WithData;

class TaskCreateRequest extends FormRequest
{
    use WithData;

    public function dataClass(): string
    {
        return TaskCreateRequestData::class;
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
            'project' => ['required', 'string'],
            'title' => ['required', 'string:255'],
            'description' => ['required', 'string'],
            'dueDate' => ['date_format:Y-m-d H:i:s'],
            'executor' => ['required', 'integer', 'exists:users,id'],
            'status' => ['required', Rule::enum(StatusEnum::class)],
        ];
    }

    public function validationData(): array
    {
        return array_merge($this->all(), $this->route()->parameters());
    }

    public function getData(): TaskCreateRequestData
    {
        return TaskCreateRequestData::from([
            ...$this->all(),
            'project' => $this->route()->parameter('project'),
        ]);
    }
}
