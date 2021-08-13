<?php

namespace App\Ship\Parents\Repositories\Eloquent;

use App\Ship\Core\Exceptions\ModelNotDefined;
use App\Ship\Parents\Repositories\Contracts\IBase;
use App\Ship\Parents\Repositories\Criteria\ICriteria;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository implements IBase, ICriteria
{
    protected Model $model;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->model = $this->getModelClass();
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->get();
    }

    /**
     * @param int $id
     * @return Model
     */
    public function find(int $id): Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param $column
     * @param $value
     * @return Collection
     */
    public function findWhere($column, $value): Collection
    {
        return $this->model->where($column, $value)->get();
    }

    /**
     * @param $column
     * @param $value
     * @return Model
     */
    public function findWhereFirst($column, $value): Model
    {
        return $this->model->where($column, $value)->firstOrFail();
    }

    /**
     * @param int $per_page
     * @return LengthAwarePaginator
     */
    public function paginate(int $per_page = 10): LengthAwarePaginator
    {
        return $this->model->paginate($per_page);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return Model
     */
    public function update(int $id, array $data)
    {
        $record = $this->find($id);
        $record->update($data);
        return $record;
    }

    /**
     * @param int $id
     * @return bool|null
     * @throws Exception
     */
    public function delete(int $id)
    {
        $record = $this->find($id);
        return $record->delete();
    }

    /**
     * @param ...$criteria
     * @return $this
     */
    public function withCriteria(...$criteria): self
    {
        $criteria = Arr::flatten($criteria);

        foreach ($criteria as $criterion) {
            $this->model = $criterion->apply($this->model);
        }

        return $this;
    }

    /**
     * @return Model
     * @throws BindingResolutionException
     * @throws ModelNotDefined
     */
    protected function getModelClass(): Model
    {
        if (! method_exists($this, 'model')) {
            throw new ModelNotDefined();
        }

        return app()->make($this->model());
    }
}
