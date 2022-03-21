<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrosDecomprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros_de_compras', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("idProduto", false, true);
            $table->integer("quantidade");
            $table->decimal("precoTotal", 8, 2);
            $table->boolean("entregarEmCasa");
            $table->string("nome", 100);
            $table->string("sobrenome", 150);
            $table->string("email");
            $table->string("bairro")->nullable();
            $table->string("rua")->nullable();
            $table->mediumInteger("numero")->nullable();
            $table->string("complemento")->nullable();
            $table->string("cidade")->nullable();
            $table->string("estado", 2)->nullable();
            $table->string("cep")->nullable();
            $table->bigInteger("numeroCartao");
            $table->string("nomeCartao");
            $table->string("validadeCartao", 10);
            $table->softDeletes();
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
        Schema::dropIfExists('registros_decompras');
    }
}
