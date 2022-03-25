<?php

namespace App\Http\Controllers;

use App\Http\Requests\Registros\StoreRegistros;
use App\Repositories\Contracts\RegistrosRepositoryContract;
use Exception;
use Illuminate\Http\Request;

class RegistrosController extends Controller
{
    private $repository;
    private const STATUS_CODE_CREATE = 201;
    private const STATUS_CODE_UPDATE = 202;
    private const STATUS_CODE_ERROR = 500;

    public function __construct(RegistrosRepositoryContract $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = 5;
        $nameSearch = $request->get("s", "");
        $field = "nome";
        try {
            if (!$list = $this->repository->paginateWithSearch($perPage, $field, $nameSearch)) {
                throw new Exception($list);
            }
            return response()->json(compact("list"));
        } catch (\Throwable $th) {
            return response()->json(compact('th'), self::STATUS_CODE_ERROR);
        }
    }

    public function listAll()
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

    public function produtosMaisVendidos()
    {
        try {
            if (!$list = $this->repository->maisVendidos()) {
                throw new Exception($list);
            }
            return response()->json(compact("list"));
        } catch (\Throwable $th) {
            return response()->json(compact('th'), self::STATUS_CODE_ERROR);
        }
    }

    public function onlyTrashed(Request $request)
    {
        try {
            $perPage = 5;
            $nameSearch = $request->get("s", "");
            $field = "nome";
            if (!$list = $this->repository->getTrash($perPage, $field, $nameSearch)) {
                throw new Exception($list);
            }
            return response()->json(compact("list"));
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), self::STATUS_CODE_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRegistros $request)
    {
        $data = $request->except("_token");
        try {
            if (!$created = $this->repository->create($data)) {
                throw new Exception($created);
            }
            return response()->json(compact("created"), self::STATUS_CODE_CREATE);
        } catch (\Throwable $th) {
            return response()->json(compact("th"), self::STATUS_CODE_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            if (!$registro = $this->repository->findOrfail($id)) {
                throw new Exception($registro);
            }
            return response()->json(compact("registro"));
        } catch (\Throwable $th) {
            return response()->json(compact("th"), self::STATUS_CODE_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRegistros $request, $id)
    {
        $data = $request->except("_token");

        try {
            if (!$updated = $this->repository->update($id, $data)) {
                throw new Exception($updated);
            }
            return response()->json(compact("updated"), self::STATUS_CODE_UPDATE);
        } catch (\Throwable $th) {
            return response()->json(compact("th"), self::STATUS_CODE_ERROR);
        }
    }

    public function restore($id)
    {
        try {
            if (!$restored = $this->repository->restore($id)) {
                throw new Exception($restored);
            }
            return response()->json(compact("restored"), self::STATUS_CODE_UPDATE);
        } catch (\Throwable $th) {
            return response()->json($th, self::STATUS_CODE_ERROR);
        }
    }

    public function forceDelete($id)
    {
        try {
            if (!$force = $this->repository->forceDelete($id)) {
                throw new Exception($force);
            }
            return response()->json(compact("force"), self::STATUS_CODE_UPDATE);
        } catch (\Throwable $th) {
            return response()->json(compact("th"), self::STATUS_CODE_ERROR);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if (!$deleted = $this->repository->delete($id)) {
                throw new Exception($deleted);
            }
            return response()->json(compact("deleted"));
        } catch (\Throwable $th) {
            return response()->json(compact("th"), self::STATUS_CODE_ERROR);
        }
    }
}
