<?php

namespace App\Repositories\Implementations;

use App\Models\Registros;
use App\Repositories\Contracts\RegistrosRepositoryContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class RegistrosRepository extends AbstractRepository implements RegistrosRepositoryContract
{
    protected $model = Registros::class;

    public function paginateWithSearch(int $perPage, string $field, string $nameSearch): LengthAwarePaginator
    {
        $mainQuery = $this->model->with(["produtos"])->when($nameSearch, function ($query) use ($field, $nameSearch) {
            $query->where($field, "like", "%$nameSearch%");
        });

        return $mainQuery->paginate($perPage);
    }

    public function findOrFail(int $id)
    {
        return $this->model->with("produtos")->findOrFail($id);
    }

    public function getTrash(int $perPage, string $field, string $nameSearch): LengthAwarePaginator
    {
        $mainQuery = $this->model->onlyTrashed()->with(["produtos"])->when($nameSearch, function ($query) use ($field, $nameSearch) {
            $query->where($field, "like", "%$nameSearch%");
        });

        return $mainQuery->paginate($perPage);
    }

    public function list(): Collection
    {
        return $this->model->with("produtos")->get();
    }

    public function maisVendidos()
    {
        $mainQuery = $this->model->limit(5)->orderBy("precoTotal", "desc");
        return $mainQuery->get();
    }
}
