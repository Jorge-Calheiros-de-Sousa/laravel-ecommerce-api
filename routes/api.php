<?php

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProdutosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource("/produtos", ProdutosController::class);
Route::get("/produtos/restore/{produto}", [ProdutosController::class, "restore"]);
Route::delete("/produtos/forceDelete/{produto}", [ProdutosController::class, "forceDelete"]);
Route::get("/produtos/onlytrashed/{produto}", [ProdutosController::class, "onlyTrashed"]);
Route::get("/produtos/image/{fileName}", [ProdutosController::class, "image"]);

Route::apiResource("/categorias", CategoriasController::class);
Route::get("/categorias/restore/{categoria}", [CategoriasController::class, "restore"]);
Route::delete("/categorias/forceDelete/{categoria}", [CategoriasController::class, "forceDelete"]);
Route::get("/categorias/listAllCategories/{categoria}", [CategoriasController::class, "listAllCategories"]);
