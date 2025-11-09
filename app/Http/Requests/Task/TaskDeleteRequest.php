<?php

namespace App\Http\Requests\Task;

use App\Domain\Task\DTO\Request\TaskCreateRequestData;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;

class TaskDeleteRequest extends FormRequest
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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function getDto()
    {
        // TODO: Implement getDto() method.
    }
}
