<?php

namespace App\Observers;

use App\Models\Registros;
use App\Repositories\Contracts\ProdutoRepositoryContract;
use App\Repositories\Contracts\ProdutosMaisVendidosRepositoryContract;
use Exception;

class RegistroObserver
{
    /**
     * Handle the Registros "created" event.
     *
     * @param  \App\Models\Registros  $registros
     * @return void
     */
    public function created(Registros $registros)
    {
        try {
            $repository = app(ProdutoRepositoryContract::class);
            $idProduto = request()->input("idProduto");
            $produto = $repository->findOrfail($idProduto);
            $estoque = $produto->estoque;
            $quantidade = request()->input("quantidade");
            $novoEstoque = $estoque - $quantidade;
            $updated = $repository->update($idProduto, ["estoque" => $novoEstoque]);
            if ($updated) {
                throw new Exception($updated);
            }
            return true;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function saving()
    {
        try {
            $repository = app(ProdutosMaisVendidosRepositoryContract::class);
            $idProduto = request()->input("idProduto");
            $quantidade = request()->input("quantidade");
            $precoTotal = request()->input("precoTotal");
            $data = [
                "idProduto" => $idProduto,
                "quantidade" => $quantidade,
                "precoTotal" => $precoTotal
            ];
            $done = $repository->updateOrCreateProduto($data);
            if ($done) {
                throw new Exception($done);
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }

    /**
     * Handle the Registros "updated" event.
     *
     * @param  \App\Models\Registros  $registros
     * @return void
     */
    public function updated(Registros $registros)
    {
        //
    }

    /**
     * Handle the Registros "deleted" event.
     *
     * @param  \App\Models\Registros  $registros
     * @return void
     */
    public function deleted(Registros $registros)
    {
        //
    }

    /**
     * Handle the Registros "restored" event.
     *
     * @param  \App\Models\Registros  $registros
     * @return void
     */
    public function restored(Registros $registros)
    {
        //
    }

    /**
     * Handle the Registros "force deleted" event.
     *
     * @param  \App\Models\Registros  $registros
     * @return void
     */
    public function forceDeleted(Registros $registros)
    {
        //
    }
}
