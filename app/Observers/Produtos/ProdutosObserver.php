<?php

namespace App\Observers\Produtos;

use App\Models\Produtos;
use App\Services\Contracts\UploadFileServiceContract;
use Exception;

class ProdutosObserver
{
    private $repository;

    public function __construct(UploadFileServiceContract $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Handle the Produtos "created" event.
     *
     * @param  \App\Models\Produtos  $produtos
     * @return void
     */
    public function created(Produtos $produtos)
    {
    }

    public function saving(Produtos $produtos)
    {
        if (request()->hasFile("foto")) {
            $this->UpdateProdutosFoto($produtos);
        }
    }

    /**
     * Handle the Produtos "updated" event.
     *
     * @param  \App\Models\Produtos  $produtos
     * @return void
     */
    public function updated(Produtos $produtos)
    {
        //
    }

    /**
     * Handle the Produtos "deleted" event.
     *
     * @param  \App\Models\Produtos  $produtos
     * @return void
     */
    public function deleted(Produtos $produtos)
    {
        //
    }

    /**
     * Handle the Produtos "restored" event.
     *
     * @param  \App\Models\Produtos  $produtos
     * @return void
     */
    public function restored(Produtos $produtos)
    {
        //
    }

    /**
     * Handle the Produtos "force deleted" event.
     *
     * @param  \App\Models\Produtos  $produtos
     * @return void
     */
    public function forceDeleted(Produtos $produtos)
    {
        //
    }

    public function UpdateProdutosFoto(Produtos $produtos)
    {
        try {
            $produtoFoto = request()->file("foto");
            $produtoDirectory = "public/produtos/cover";
            if (!$fileName = $this->repository->run($produtoFoto, $produtoDirectory)) {
                throw new Exception("Não foi possivel fazer o upload da imagem");
            }
            $produtos->foto = $fileName;
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
