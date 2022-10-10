<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateRelatorioSegundoTrimestre extends FormRequest
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
            'telefone' => ['required', 'numeric', 'min:8'],
            'outros_beneficios' => ['required'],
            'placa_proedi' => ['required'],
            'placa_proedi_upload' => ['required_if:placa_proedi,==,sim', 'mimes:jpeg,bmp,png', 'max:4096'],
            'faturamento_abril' => ['required'],
            'faturamento_maio' => ['required'],
            'faturamento_junho' => ['required'],
            'faturamento_upload' => ['required', 'mimes:pdf', 'max:2048'],
            'empregos_gerados_trimestre_abril' => ['required', 'numeric'],
            'empregos_gerados_trimestre_maio' => ['required', 'numeric'],
            'empregos_gerados_trimestre_junho' => ['required', 'numeric'],
            'empregos_gerados_trimestre_upload' => ['required', 'mimes:pdf', 'max:2048'],
            'empregos_gerados_proedi' => ['required', 'numeric'],
            'empregos_gerados_proedi_upload' => ['required', 'mimes:pdf', 'max:2048'],
            'materia_prima_adquirida_rn' => ['required'],
            'materia_prima_adquirida_rn_upload' => ['required', 'mimes:pdf', 'max:5120'],
            'icms_total_devido_abril' => ['required'],
            'icms_total_devido_maio' => ['required'],
            'icms_total_devido_junho' => ['required'],
            'icms_total_devido_upload' => ['required', 'mimes:pdf', 'max:5120'],
            'icms_total_pago_abril' => ['required'],
            'icms_total_pago_maio' => ['required'],
            'icms_total_pago_junho' => ['required'],
            'icms_total_pago_upload' => ['required', 'mimes:pdf', 'max:5120'],
            'investimento_projetado' => ['required'],
            'investimento_projetado_upload' => ['required', 'mimes:pdf', 'max:5120'],
            'investimento_realizado_abril' => ['required'],
            'investimento_realizado_maio' => ['required'],
            'investimento_realizado_junho' => ['required'],
            'investimento_realizado_upload' => ['required', 'mimes:pdf', 'max:5120'],
            'investimento_total_realizado' => ['required'],
            'investimento_total_realizado_upload' => ['required', 'mimes:pdf', 'max:5120'],
            'n_empregos_diretos_atuais' => ['required'],
            'n_empregos_diretos_atuais_upload' => ['required', 'mimes:pdf', 'max:4096'],
            
            'aprendizes' => ['required'],
            'possui_menores_aprendizes' => ['required_if:aprendizes,sim'],
            'possui_menores_aprendizes_upload' => ['required_with_all:possui_menores_aprendizes', 'mimes:pdf', 'max:4096'],
           
            'estagiarios' => 'required',
            'possui_estagiarios' => ['required_if:estagiarios,sim'],
            'possui_estagiarios_upload' => ['required_with_all:possui_estagiarios', 'mimes:pdf', 'max:4096'],

            'trainee' => 'required',
            'possui_trainee' => ['required_if:trainee,sim'],
            'possui_trainee_upload' => ['required_with_all:possui_trainee', 'mimes:pdf', 'max:4096'],
            
            'destino_mercadoria' => ['required'],
            'destino_mercadoria_upload' => ['required', 'mimes:pdf', 'max:5120'],
        ];
    }
}
