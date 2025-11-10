<?php

namespace App\Domain\Task\DTO\Request;

use App\Domain\Task\Enum\StatusEnum;
use DateTimeInterface;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;

class TaskCreateRequestData extends Data
{
    public function __construct(
        public string $project,
        public string $title,
        public string $description,
        #[WithCast(EnumCast::class, StatusEnum::class)]
        public StatusEnum $status,
        public int $executor,
        public ?array $attachments,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public ?Carbon $dueDate,
    ) {}
}
