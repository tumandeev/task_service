<?php

namespace App\Domain\Task\DTO;

use App\Domain\Task\Enum\StatusEnum;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;

class TaskFilterData extends Data
{
    public function __construct(
        #[WithCast(EnumCast::class, StatusEnum::class)]
        public ?StatusEnum $status,
        public ?int $executor,
        public ?string $project,
        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d H:i:s')]
        public ?Carbon $dueDate,
    ) {}
}
