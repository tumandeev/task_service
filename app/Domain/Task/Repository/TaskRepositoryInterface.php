<?php

namespace App\Domain\Task\Repository;

use App\Domain\Task\DTO\TaskFilterData;
use App\Domain\Task\DTO\TaskUpdateData;
use App\Domain\Task\DTO\TaskCreateData;
use App\Domain\Task\DTO\TaskData;
use Illuminate\Support\Collection;

interface TaskRepositoryInterface
{
    public function find(int $id): ?TaskData;
    public function create(TaskCreateData $data): TaskData;
    public function update(int $id, TaskUpdateData $data): TaskData;
    public function delete(int $id): bool;
    public function search(TaskFilterData $filter): Collection;
}
