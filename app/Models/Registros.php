<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registros extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "registros_de_compras";

    protected $fillable = [
        "idProduto",
        "quantidade",
        "precoTotal",
        "entregarEmCasa",
        "nome",
        "sobrenome",
        "email",
        "bairro",
        "rua",
        "numero",
        "complemento",
        "cidade",
        "estado",
        "cep",
        "numeroCartao",
        "nomeCartao",
        "validadeCartao"
    ];

    public function produtos()
    {
        return $this->belongsTo(Produtos::class, "idProduto");
    }
}
