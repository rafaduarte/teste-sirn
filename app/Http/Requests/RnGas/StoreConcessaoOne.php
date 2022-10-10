<?php

namespace App\Http\Requests\RnGas;

use Illuminate\Foundation\Http\FormRequest;

class StoreConcessaoOne extends FormRequest
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
            'requerimento' => ['required', 'mimes:pdf', 'max:2048'],
            'instrumento_constitutivo' => ['required', 'mimes:pdf', 'max:5120'],           
            'procuracao' => ['required', 'mimes:pdf', 'max:2048'],           
            'contrato_social_aditivos' => ['required', 'mimes:pdf', 'max:2048'],
            'cartao_cnpj' => ['required', 'mimes:pdf', 'max:2048'],
            'inscricao_estadual' => ['required', 'mimes:pdf', 'max:2048'],
            'certidao_federal' => ['required', 'mimes:pdf', 'max:2048'],
            'certidao_estadual' => ['required', 'mimes:pdf', 'max:2048'],
            'certidao_municipal' => ['required', 'mimes:pdf', 'max:2048'],
            'certidao_trabalhista' => ['required', 'mimes:pdf', 'max:2048'],
            'certidao_fgts' => ['required', 'mimes:pdf', 'max:2048'],
            'ata_constituicao' => ['required', 'mimes:pdf', 'max:2048'],           
        ];
    }
}
