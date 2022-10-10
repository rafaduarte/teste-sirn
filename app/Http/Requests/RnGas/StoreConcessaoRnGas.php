<?php

namespace App\Http\Requests\RnGas;

use Illuminate\Foundation\Http\FormRequest;

class StoreConcessaoRnGas extends FormRequest
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
            'estudo_viabilidade' => ['required', 'mimes:pdf', 'max:2048'],           
            'justificativa_tecnico_economica' => ['required', 'mimes:pdf', 'max:2048'],
            'procuracao' => ['required', 'mimes:pdf', 'max:2048'],
            'contrato_social_aditivos' => ['required', 'mimes:pdf', 'max:2048'],
            'cartao_cnpj' => ['required', 'mimes:pdf', 'max:2048'],
            'inscricao_estadual' => ['required', 'mimes:pdf', 'max:2048'],
            'certidao_federal' => ['required', 'mimes:pdf', 'max:2048'],
            'certidao_estadual' => ['required', 'mimes:pdf', 'max:2048'],
            'certidao_municipal' => ['required', 'mimes:pdf', 'max:2048'],
            'certidao_trabalhista' => ['required', 'mimes:pdf', 'max:2048'],
            'certidao_fgts' => ['required', 'mimes:pdf', 'max:5120'],
            'ata_constituicao' => ['required', 'mimes:pdf', 'max:5120'],
            'produtos_processos' => ['required', 'mimes:pdf', 'max:5120'],
            'projecao_receitas' => ['required', 'mimes:pdf', 'max:5120'],
            'projecao_custos' => ['required', 'mimes:pdf', 'max:5120'],
            'investimento' => ['required', 'mimes:pdf', 'max:5120'],
            'projecao_fluxo_caixa' => ['required', 'mimes:pdf', 'max:5120'],
            'consumo_gas_mes' => ['required', 'mimes:pdf', 'max:5120'],
            'demanda_gas_tres_anos' => ['required', 'mimes:pdf', 'max:5120'],
            'percentual_gas' => ['required', 'mimes:pdf', 'max:5120'],
            'quantidade_empregos' => ['required', 'mimes:pdf', 'max:5120'],                       
            'documentos' => 'required',
        ];
    }
}
