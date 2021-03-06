<?php

namespace App\Http\Requests\Produtos;

use Illuminate\Foundation\Http\FormRequest;

use function PHPSTORM_META\map;

class StoreProdutos extends FormRequest
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
            "nome" => "required|min:5|max:100",
            "preco" => "required",
            "categoria" => "required",
            "foto" => "nullable|file",
            "descricao" => "nullable",
            "estoque" => "required|min:1"
        ];
    }
}
