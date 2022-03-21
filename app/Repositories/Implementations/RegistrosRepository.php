<?php

namespace App\Repositories\Implementations;

use App\Models\Registros;
use App\Repositories\Contracts\RegistrosRepositoryContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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

    public function getTrash(int $perPage, string $field, string $nameSearch): LengthAwarePaginator
    {
        $mainQuery = $this->model->onlyTrashed()->with(["produtos"])->when($nameSearch, function ($query) use ($field, $nameSearch) {
            $query->where($field, "like", "%$nameSearch%");
        });

        return $mainQuery->paginate($perPage);
    }
}
