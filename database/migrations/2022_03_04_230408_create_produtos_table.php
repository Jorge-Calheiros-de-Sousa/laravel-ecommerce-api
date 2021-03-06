<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string("nome", 200);
            $table->decimal("preco");
            $table->text("foto")->nullable(true);
            $table->bigInteger("categoria", false, true);
            $table->text("descricao")->nullable(true);
            $table->mediumInteger("estoque");
            $table->softDeletes();
            $table->timestamps();

            $table->foreign("categoria")->references("id")->on("categorias");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
