<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutosMaisVendidos extends Model
{
    use HasFactory;

    protected $table = "produtos_mais_vendidos";

    protected $fillable = [
        'idProduto',
        'quantidade',
        'precoTotal'
    ];

    public function produtos()
    {
        return $this->belongsTo(Produtos::class, "idProduto");
    }
}
