<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConcessaoProedi extends FormRequest
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
            
            //'nome_empresa' => ['required', 'min:3'],
            'requerimento' => ['required', 'mimes:pdf', 'max:2048'],
            'projeto' => ['required', 'mimes:pdf', 'max:5120'],
            'nome_projetista' => 'required',
            'cpf_projetista' => 'required',
            'telefone_projetista' => ['required', 'numeric'],
            'nome_projetista' => ['required'],
            'endereco_projetista' => ['required'],
            'municipio_projetista' => ['required'],
            'uf_projetista' => ['required'],
            'documento_projetista' => 'required',
            'inscricao_estadual' => ['required', 'mimes:pdf', 'max:2048'],
            'certidao_federal' => ['required', 'mimes:pdf', 'max:2048'],
            'certidao_estadual' => ['required', 'mimes:pdf', 'max:2048'],
            'certidao_municipal' => ['required', 'mimes:pdf', 'max:2048'],
            'certidao_trabalhista' => ['required', 'mimes:pdf', 'max:2048'],
            'certidao_fgts' => ['required', 'mimes:pdf', 'max:2048'],
            'ata_constituicao' => ['required', 'mimes:pdf', 'max:2048'],
            'procuracao_responsavel' => ['required', 'mimes:pdf', 'max:2048'],
            'rg_responsavel' => ['required', 'mimes:pdf', 'max:2048'],
            'comprovante_residencia' => ['required', 'mimes:pdf', 'max:2048'],
            'relatorio_gfip' => ['required', 'mimes:pdf', 'max:5120'],
            'relatorio_faturamento' => ['required', 'mimes:pdf', 'max:5120'],
            'documentos' => ['nullable', 'mimes:pdf', 'max:5120'],

            //'documentos' => ['required', 'array' ],
            //'documentos.*' => ['required', 'mimes:pdf'],
        ];
       /* $documentos = count($this->input('documentos'));
        foreach(range(0, $documentos) as $index) {
            $rules['documentos.' . $index] = 'mimes:pdf|max:5000';
        }

        return $rules; */
    }
}
