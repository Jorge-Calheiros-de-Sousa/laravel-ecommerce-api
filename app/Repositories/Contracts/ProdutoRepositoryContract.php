<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ProdutoRepositoryContract
{
    public function create(array $data);

    public function update(int $id, array $data);

    public function  delete(int $id);

    public function list(): Collection;

    public function paginateWithSearch(int $perPage, string $title, string $nameSearch, string $categoria): LengthAwarePaginator;

    public function getTrash(int $perPage, string $field, string $nameSearch, string $categoria): LengthAwarePaginator;

    public function findOrfail(int $id);

    public function restore(int $id);

    public function forceDelete(int $id);

    public function resolveModel();
}
