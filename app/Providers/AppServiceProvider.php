<?php

namespace App\Providers;

use App\Repositories\Contracts\CategoriaRepositoryContract;
use App\Repositories\Contracts\ProdutoRepositoryContract;
use App\Repositories\Contracts\RegistrosRepositoryContract;
use App\Repositories\Implementations\CategoriaRepository;
use App\Repositories\Implementations\ProdutoRepository;
use App\Repositories\Implementations\RegistrosRepository;
use App\Services\Contracts\UploadFileServiceContract;
use App\Services\Implementations\UploadFileService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProdutoRepositoryContract::class, ProdutoRepository::class);
        $this->app->bind(CategoriaRepositoryContract::class, CategoriaRepository::class);
        $this->app->bind(UploadFileServiceContract::class, UploadFileService::class);
        $this->app->bind(RegistrosRepositoryContract::class, RegistrosRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
