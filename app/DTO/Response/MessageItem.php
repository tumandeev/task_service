<?php

namespace App\DTO\Response;

class MessageItem
{
    public function __construct(
        public string $type,    // info | success | warning | error
        public string $text,    // сам текст уведомления
    ) {}

    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'text' => $this->text,
        ];
    }

    public static function make(string $text, string $type = 'info'): self
    {
        return new self($type, $text);
    }
}
