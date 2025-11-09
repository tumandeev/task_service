<?php

namespace App\Domain\Task\Enum;

enum StatusEnum: string
{
    case PLANNED = 'planned';
    case IN_PROGRESS = 'in_progress';
    case DONE = 'done';
}
