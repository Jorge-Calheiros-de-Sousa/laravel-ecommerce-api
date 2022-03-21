<?php

namespace App\Http\Requests\Registros;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistros extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "idProduto" => "required",
            "quantidade" => "required",
            "precoTotal" => "required",
            "entregarEmCasa" => "required",
            "nome" => "required",
            "sobrenome" => "required",
            "email" => "required",
            "bairro",
            "rua",
            "numero",
            "complemento",
            "cidade",
            "estado",
            "cep" => "max:8|min:8",
            "numeroCartao"  => "required",
            "nomeCartao" => "required",
            "validadeCartao" => "required"
        ];
    }
}
