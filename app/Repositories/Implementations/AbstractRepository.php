<?php

namespace App\Repositories\Implementations;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

abstract class AbstractRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    public function list(): Collection
    {
        return $this->model->all();
    }

    public function paginateWithSearch(int $perPage, string $field, string $nameSearch): LengthAwarePaginator
    {
        $mainQuery = $this->model->when($nameSearch, function ($query) use ($field, $nameSearch) {
            $query->where($field, "like", "%$nameSearch%");
        });
        return $mainQuery->paginate($perPage);
    }

    public function findOrFail(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->fill($data)->save();
    }

    public function update(int $id, array $data)
    {
        $model = $this->model->findOrFail($id);
        $model->fill($data);

        return $model->save();
    }

    public function delete(int $id)
    {
        $model = $this->model->findOrFail($id);
        return $model->delete();
    }

    public function restore(int $id)
    {
        return $this->model->withTrashed()->findOrFail($id)->restore();
    }

    public function forceDelete(int $id)
    {
        return $this->model->withTrashed()->findOrFail($id)->forceDelete();
    }

    public function resolveModel()
    {
        return app($this->model);
    }
}
