<?php

namespace App\Repositories\Eloquent;


use App\Support\Traits\DataMap;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

abstract class BaseRepository
{
    use RepositoryTrait, DataMap;

    protected string|Data $createDataClass;

    protected string|Data $updateDataClass;

    protected string|Data $dataClass;

    public function __construct(
        protected Model $model,
    )
    {
    }

    public function doFindOrFail(int $id): ?Data
    {
        return $this->dataClass::from(
            $this->model->findOrFail($id)
        );
    }

    public function doCreate(Data $data): Data
    {
        if (!$data instanceof $this->createDataClass) {
            throw new \InvalidArgumentException(
                sprintf('Expected %s, got %s', $this->createDataClass, $data::class)
            );
        }

        $model = $this->model->newInstance();

        $data = $data->toArray();

        static::arrayKeysToSnake($data);
        $model->fill($data);
        $model->save();

        return $this->dataClass::from($model);
    }

    public function doUpdate(int $id, Data $data): Data
    {
        if (!$data instanceof $this->updateDataClass) {
            throw new \InvalidArgumentException(
                sprintf('Expected %s, got %s', $this->updateDataClass, $data::class)
            );
        }

        $model = $this->model->findOrFail($id);

        $data = $data->toArray();
        static::arrayKeysToSnake($data);
        $data = array_filter($data, fn($v) => !is_null($v));

        $model->fill($data);
        $model->save();

        return $this->dataClass::from($model);
    }

    public function doDelete(int $id): bool
    {
        $model = $this->model->findOrFail($id);
        return $model->delete();
    }

    public function doSearch(Data $filter): Collection
    {
        $query = $this->model::query();

        $filter = $filter->toArray();
        /** @var array $filter */
        static::arrayKeysToSnake($filter);
        $filter = array_filter($filter, fn($v) => !is_null($v));
        $query->where($filter);
        $models = $query->get();

        return $models->map(fn($model) => $this->dataClass::from($model));
    }
}
