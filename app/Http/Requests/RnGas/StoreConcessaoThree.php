<?php

namespace App\Http\Requests\RnGas;

use Illuminate\Foundation\Http\FormRequest;

class StoreConcessaoThree extends FormRequest
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
            'estudo_viabilidade' => ['required', 'mimes:pdf', 'max:5120'],           
            'justificativa_tecnico_economica' => ['required', 'mimes:pdf', 'max:2048'],
            'nome_tecnico' => 'required',
            'cpf_tecnico' => 'required',
            'telefone_tecnico' => 'required',
            'endereco_tecnico' => 'required',
            'municipio_tecnico' => 'required',
            'uf_tecnico' => 'required',
            'documento_tecnico' => ['required', 'mimes:pdf', 'max:2048'],
            'documentos' => ['nullable', 'mimes:pdf', 'max:5120'],            
        ];
    }
}
