<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRelatorioProedi extends FormRequest
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
                       
            'telefone' => ['required', 'numeric'],
            'outros_beneficios' => ['required', 'max:8'],
            'placa_proedi' => ['required'],
            'placa_proedi_upload' => ['required_if:placa_proedi,==,sim', 'mimes:jpeg,bmp,png', 'max:4026'],
            'faturamento_janeiro' => ['required'],
            'faturamento_fevereiro' => ['required'],
            'faturamento_marco' => ['required'],
            'faturamento_upload' => ['required', 'mimes:pdf', 'max:4026'],
            'empregos_gerados_trimestre_janeiro' => ['required', 'numeric'],
            'empregos_gerados_trimestre_fevereiro' => ['required', 'numeric'],
            'empregos_gerados_trimestre_marco' => ['required', 'numeric'],
            'empregos_gerados_trimestre_upload' => ['required', 'mimes:pdf', 'max:4026'],
            'empregos_gerados_proedi' => ['required', 'numeric'],
            'empregos_gerados_proedi_upload' => ['required', 'mimes:pdf', 'max:4026'],
            'materia_prima_adquirida_rn' => ['required'],
            'materia_prima_adquirida_rn_upload' => ['required', 'mimes:pdf', 'max:4026'],
            'icms_total_devido_janeiro' => ['required'],
            'icms_total_devido_fevereiro' => ['required'],
            'icms_total_devido_marco' => ['required'],
            'icms_total_devido_upload' => ['required', 'mimes:pdf', 'max:5120'],
            'icms_total_pago_janeiro' => ['required'],
            'icms_total_pago_fevereiro' => ['required'],
            'icms_total_pago_marco' => ['required'],
            'icms_total_pago_upload' => ['required', 'mimes:pdf', 'max:5120'],
            'investimento_projetado' => ['required'],
            'investimento_projetado_upload' => ['required', 'mimes:pdf', 'max:5120'],
            'investimento_realizado_janeiro' => ['required'],
            'investimento_realizado_fevereiro' => ['required'],
            'investimento_realizado_marco' => ['required'],
            'investimento_realizado_upload' => ['required', 'mimes:pdf', 'max:5120'],
            'investimento_total_realizado' => ['required'],
            'investimento_total_realizado_upload' => ['required', 'mimes:pdf', 'max:5120'],
            'n_empregos_diretos_atuais' => ['required', 'max:1020'],
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
            
            'destino_mercadoria' => ['required', 'max:4096'],
            'destino_mercadoria_upload' => ['required', 'mimes:pdf', 'max:5120'], 
           
        ];        
    }
}
