<?php

namespace App\Repositories\Eloquent;



use App\Domain\Task\DTO\TaskFilterData;
use App\Domain\Task\DTO\TaskUpdateData;
use App\Domain\Task\DTO\TaskCreateData;
use App\Domain\Task\DTO\TaskData;
use App\Domain\Task\Repository\TaskRepositoryInterface;
use App\Models\Task;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

/** @extends BaseRepository<TaskCreateData, TaskData> */
class TaskRepository extends BaseRepository implements TaskRepositoryInterface
{
    protected string|Data $createDataClass = TaskCreateData::class;
    protected string|Data $updateDataClass = TaskUpdateData::class;
    protected string|Data $dataClass = TaskData::class;
    public function __construct(
        Task $model,
    )
    {
        parent::__construct($model);
    }

    public function find(int $id): ?TaskData
    {
        /** @var TaskData|null $result */
        $result = parent::doFindOrFail($id);
        return $result;
    }


    public function create(TaskCreateData $data): TaskData
    {
        /** @var TaskData $result */
        $result = parent::doCreate($data);
        return $result;
    }

    public function update(int $id, TaskUpdateData $data): TaskData
    {
        /** @var TaskData $result */
        $result = parent::doUpdate($id, $data);
        return $result;
    }

    public function delete(int $id): TaskData
    {
        /** @var TaskData $result */
        $result = parent::doDelete($id);
        return $result;
    }

    public function search(TaskFilterData $filter): Collection
    {
        return parent::doSearch($filter);
    }

}
