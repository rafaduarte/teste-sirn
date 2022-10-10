<?php

namespace App\Http\Requests\RnGas;

use Illuminate\Foundation\Http\FormRequest;

class StoreRnGas extends FormRequest
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
            'name' => 'required',
            'desconto' => ['required', 'numeric'],
            'area_atuacao' => ['required',  'max:255'],
            'produto' => ['required', 'max:255'],
            'tipo_empresa' => ['required', 'max:255'],
            'municipio' => ['required', 'max:255'],
            'data_inicio' => 'required',
            'data_final' => 'required',
        ];
    }
}
