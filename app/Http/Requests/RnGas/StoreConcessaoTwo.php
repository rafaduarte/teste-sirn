<?php

namespace App\Http\Requests\RnGas;

use Illuminate\Foundation\Http\FormRequest;

class StoreConcessaoTwo extends FormRequest
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
            'produtos_processos' => 'required',
            'comprovante_produtos_processos' => ['required', 'mimes:pdf', 'max:2048'],
            'projecao_receitas' => 'required',
            'comprovante_projecao_receitas' => ['required', 'mimes:pdf', 'max:5120'],           
            'projecao_custos' => 'required',
            'comprovante_projecao_custos' => ['required', 'mimes:pdf', 'max:2048'],           
            'investimento' => 'required',
            'Comprovante_investimento' => ['required', 'mimes:pdf', 'max:2048'],
            'projecao_fluxo_caixa' => 'required',
            'comprovante_fluxo_caixa' => ['required', 'mimes:pdf', 'max:2048'],
            'consumo_gas_mes' => 'required',
            'comprovante_consumo' => ['required', 'mimes:pdf', 'max:2048'],
            'demanda_gas_tres_anos' => 'required',
            'comprovante_demanda' => ['required', 'mimes:pdf', 'max:2048'],
            'percentual_gas' => 'required',
            'comprovante_percentual_gas' => ['required', 'mimes:pdf', 'max:2048'],
            'quantidade_empregos' => 'required',
            'comprovante_quantidade_empregos' => ['required', 'mimes:pdf', 'max:2048'],            
        ];
    }
}
