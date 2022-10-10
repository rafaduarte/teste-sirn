<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequerimentoProedi extends FormRequest
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
            'social_name' => 'required',
            'inscricao_estadual' => 'required',
            'cnpj' => 'required',
            'endereco_empresa' => 'required',
            'municipio' => 'required',
            'cep' => 'required',
            'telefone' => 'required',          
            'email' => 'required',           
        ];
    }
}
