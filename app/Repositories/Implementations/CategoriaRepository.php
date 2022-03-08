<?php

namespace App\Repositories\Implementations;

use App\Repositories\Contracts\CategoriaRepositoryContract;
use App\Models\Categorias;

class CategoriaRepository extends AbstractRepository implements CategoriaRepositoryContract
{
    protected $model = Categorias::class;
}
