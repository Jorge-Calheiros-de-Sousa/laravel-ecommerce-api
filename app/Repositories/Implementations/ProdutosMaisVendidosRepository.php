<?php

namespace App\Repositories\Implementations;

use App\Models\ProdutosMaisVendidos;
use App\Repositories\Contracts\ProdutosMaisVendidosRepositoryContract;
use Illuminate\Support\Collection;

class ProdutosMaisVendidosRepository extends AbstractRepository implements ProdutosMaisVendidosRepositoryContract
{
    protected $model = ProdutosMaisVendidos::class;

    public function list(): Collection
    {
        return $this->model->with("produtos")->orderBy("quantidade", 'DESC')->limit(5)->get();
    }

    public function updateOrCreateProduto(array $data)
    {
        $registro = $this->model->where("idProduto", $data["idProduto"])->get();
        if (sizeof($registro) == 0) {
            return $this->model->fill($data)->save();
        } else {
            $novaQuantidade = $registro->first()->quantidade + $data["quantidade"];
            $novoPreco = $registro->first()->precoTotal + $data["precoTotal"];
            $id = $registro->first()->id;

            $dataNova = [
                "quantidade" => $novaQuantidade,
                "precoTotal" => $novoPreco
            ];
            $model = $this->model->findOrFail($id);
            return $model->fill($dataNova)->save();
        }
    }
}
