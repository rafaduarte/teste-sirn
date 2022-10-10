<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConcessaoProedi extends FormRequest
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
            'requerimento' => ['nullable', 'mimes:pdf', 'max:2048'],
            'projeto' => ['nullable', 'mimes:pdf', 'max:5120'],
            'nome_projetista' => 'required',
            'cpf_projetista' => ['required', 'numeric'],
            'telefone_projetista' => ['required', 'numeric'],
            'nome_projetista' => ['required'],
            'endereco_projetista' => ['required'],
            'municipio_projetista' => ['required'],
            'uf_projetista' => ['required'],
            'documento_projetista' => 'nullable',
            'inscricao_estadual' => ['nullable', 'mimes:pdf', 'max:2048'],
            'certidao_federal' => ['nullable', 'mimes:pdf', 'max:2048'],
            'certidao_estadual' => ['nullable', 'mimes:pdf', 'max:2048'],
            'certidao_municipal' => ['nullable', 'mimes:pdf', 'max:2048'],
            'certidao_trabalhista' => ['nullable', 'mimes:pdf', 'max:2048'],
            'certidao_fgts' => ['nullable', 'mimes:pdf', 'max:2048'],
            'ata_constituicao' => ['nullable', 'mimes:pdf', 'max:2048'],
            'procuracao_responsavel' => ['nullable', 'mimes:pdf', 'max:2048'],
            'rg_responsavel' => ['nullable', 'mimes:pdf', 'max:2048'],
            'comprovante_residencia' => ['nullable', 'mimes:pdf', 'max:2048'],
            'relatorio_gfip' => ['nullable', 'mimes:pdf', 'max:5120'],
            'relatorio_faturamento' => ['nullable', 'mimes:pdf', 'max:5120'],
            'documentos' => ['nullable', 'mimes:pdf', 'max:5120'],
        ];
    }
}
