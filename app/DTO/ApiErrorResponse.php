<?php

namespace App\DTO;

use App\DTO\Contracts\ApiResponse;
use Illuminate\Http\JsonResponse;
use JsonSerializable;
use Throwable;

class ApiErrorResponse implements ApiResponse
{
    /**
     * @param ErrorDetails[]|null $errors
     */
    public function __construct(
        public string  $message,
        public int     $status = 400,
        public ?array  $errors = null,
    )
    {
    }

    public static function fromException(Throwable $e): self
    {
        return new self(
            message: $e->getMessage() ?: 'Server error',
            status: method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500,
        );
    }

    public static function validation(array $errors, string $message = 'Validation failed'): self
    {
        return new self(
            message: $message,
            status: 422,
            errors: ErrorDetails::fromArray($errors),
        );
    }

    public function toResponse(): JsonResponse
    {
        return response()->json([
            'success' => false,
            'error' => [
                'message' => $this->message,
                'details' => $this->errors ? array_map(fn($error) => $error->toArray(), $this->errors) : null,
            ],
        ], $this->status);
    }
}
