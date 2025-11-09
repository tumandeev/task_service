<?php
namespace App\DTO\Response;

use App\DTO\Response\Contracts\ApiResponse;
use Illuminate\Http\JsonResponse;

class ApiSuccessResponse implements ApiResponse
{
    /**
     * @param MessageItem[]|null $messages
     */
    public function __construct(
        public mixed $data = null,
        public int $status = 200,
        public ?array $messages = null,
        public ?array $meta = null,
    ) {}

    public static function make(
        mixed $data = null,
        array|string|null $messages = null,
        int $status = 200,
        ?array $meta = null
    ): self {
        $messagesArray = match (true) {
            is_string($messages) => [MessageItem::make($messages, 'info')],
            is_array($messages) && (empty($messages) || $messages[0] instanceof MessageItem) => $messages,
            default => [],
        };

        return new self($data, $status, $messagesArray, $meta);
    }

    public function toResponse(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $this->data
//            'messages' => $this->messages
//                ? array_map(fn($m) => $m->toArray(), $this->messages)
//                : null,
//            'meta' => $this->meta,
        ], $this->status);
    }
}
