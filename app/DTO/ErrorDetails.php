<?php

namespace App\DTO;

class ErrorDetails
{
    public function __construct(
        public string $field,
        public array $messages,
    ) {}

    public static function fromArray(array $errors): array
    {
        return collect($errors)
            ->map(fn($messages, $field) => new self($field, (array)$messages))
            ->values()
            ->all();
    }

    public function toArray(): array
    {
        return [
            'field' => $this->field,
            'messages' => $this->messages,
        ];
    }
}
