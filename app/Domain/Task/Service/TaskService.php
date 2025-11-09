<?php

namespace App\Domain\Task\Service;

use App\Domain\Task\DTO\TaskFilterData;
use App\Domain\Task\DTO\TaskUpdateData;
use App\Domain\Task\DTO\TaskCreateData;
use App\Domain\Task\DTO\TaskData;
use App\Domain\Task\Repository\TaskRepositoryInterface;
use Illuminate\Support\Collection;

class TaskService implements TaskServiceInterface
{
    public function __construct(public TaskRepositoryInterface $taskRepository)
    {
    }

    public function find(int $id): ?TaskData
    {
        return $this->taskRepository->find($id);
    }

    public function create(TaskCreateData $data): TaskData
    {
        return $this->taskRepository->create($data);
    }

    public function update(int $id, TaskUpdateData $data): TaskData
    {
        return $this->taskRepository->update($id, $data);
    }

    public function delete(int $id): TaskData
    {
        return $this->taskRepository->delete($id);
    }

    public function search(TaskFilterData $filter): Collection
    {
        return $this->taskRepository->search($filter);
    }
}
