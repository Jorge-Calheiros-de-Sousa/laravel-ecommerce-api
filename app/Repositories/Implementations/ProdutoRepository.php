<?php

namespace App\Repositories\Implementations;

use App\Repositories\Contracts\ProdutoRepositoryContract;
use App\Models\Produtos;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProdutoRepository extends AbstractRepository implements ProdutoRepositoryContract
{
    protected $model = Produtos::class;

    public function paginateWithSearch(int $perPage, string $field, string $nameSearch, string $categoria = ""): LengthAwarePaginator
    {
        $mainQuery = $this->model->with(["categoria"])->when($nameSearch, function ($query) use ($field, $nameSearch) {
            $query->where($field, "like", "%$nameSearch%");
        })
            ->when($categoria, function ($query) use ($categoria) {
                $query->whereHas("categoria", function ($query) use ($categoria) {
                    $query->where("categorias.slug", $categoria);
                });
            });

        return $mainQuery->paginate($perPage);
    }
}
