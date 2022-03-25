<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosMaisVendidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos_mais_vendidos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("idProduto", false, true);
            $table->bigInteger("quantidade");
            $table->decimal("precoTotal");
            $table->timestamps();

            $table->foreign("idProduto")->references("id")->on("produtos");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos_mais_vendidos');
    }
}
