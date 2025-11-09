<?php

namespace App\Http\Controllers;

use App\Domain\Task\DTO\TaskCreateData;
use App\Domain\Task\DTO\TaskData;
use App\Domain\Task\DTO\TaskFilterData;
use App\Domain\Task\DTO\TaskUpdateData;
use App\Domain\Task\Service\TaskServiceInterface;
use Illuminate\Support\Collection;
use App\Http\Requests\{Task\TaskCreateRequest,
    Task\TaskDeleteRequest,
    Task\TaskListRequest,
    Task\TaskUpdateRequest};
use App\Models\Task;

class TaskController extends Controller
{

    public function __construct(
        public TaskServiceInterface $taskService,
    )
    {}

    public function create(TaskCreateRequest $request): TaskData
    {
        $data = TaskCreateData::from($request->getData());
        return  $this->taskService->create($data);
    }

    public function update(TaskUpdateRequest $request, int $taskId): TaskData
    {
        $data = TaskUpdateData::from($request->getData());
        return  $this->taskService->update($taskId, $data);
    }

    public function search(TaskListRequest $request): Collection
    {
        $filterData = TaskFilterData::from($request->getData());
        return  $this->taskService->search($filterData);
    }

    public function find(int $taskId): TaskData
    {
        return  $this->taskService->find($taskId);
    }


    public function delete(TaskDeleteRequest $request)
    {

    }
}
