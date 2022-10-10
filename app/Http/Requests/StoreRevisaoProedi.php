<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRevisaoProedi extends FormRequest
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
            'certidao_estadual' => ['required', 'mimes:pdf', 'max:2048'],
            'certidao_trabalhista' => ['required', 'mimes:pdf', 'max:2048'],
            'certidao_fgts' => ['required', 'mimes:pdf', 'max:2048'],
            'carta_motivos' => ['required', 'mimes:pdf', 'max:2048'],
            'motivos' => ['required', 'array'],
            'mudanca_local' => ['nullable', 'mimes:pdf', 'max:2048'],
            'faturamento' => ['nullable', 'mimes:pdf', 'max:2048'],
            'empregados' => ['nullable', 'mimes:pdf', 'max:2048'],
            'materia_prima' => ['nullable', 'mimes:pdf', 'max:2048'],
            'investimento_ped' => ['nullable', 'mimes:pdf', 'max:2048'],
            'investimento_conservacao' => ['nullable', 'mimes:pdf', 'max:2048'],
            'investimento_mao_obra' => ['nullable', 'mimes:pdf', 'max:2048'],
        ];
    }
}
