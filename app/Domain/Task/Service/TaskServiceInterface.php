<?php

namespace App\Domain\Task\Service;

use App\Domain\Task\DTO\TaskUpdateData;
use App\Domain\Task\DTO\TaskCreateData;
use App\Domain\Task\DTO\TaskData;

interface TaskServiceInterface
{
    public function find(int $id): ?TaskData;
    public function create(TaskCreateData $data): TaskData;
    public function update(int $id, TaskUpdateData $data): TaskData;
    public function delete(int $id): bool;
}
