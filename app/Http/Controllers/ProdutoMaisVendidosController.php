<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ProdutosMaisVendidosRepositoryContract;
use Exception;
use Illuminate\Http\Request;

class ProdutoMaisVendidosController extends Controller
{
    private $repository;
    private const STATUS_CODE_CREATE = 201;
    private const STATUS_CODE_UPDATE = 202;
    private const STATUS_CODE_ERROR = 500;

    public function __construct(ProdutosMaisVendidosRepositoryContract $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            if (!$list = $this->repository->list()) {
                throw new Exception($list);
            }
            return response()->json(compact("list"));
        } catch (\Throwable $th) {
            return response()->json(compact('th'), self::STATUS_CODE_ERROR);
        }
    }
}
