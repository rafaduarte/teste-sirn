<?php

namespace App\Models\RnGas;

use Illuminate\Database\Eloquent\Model;

class RnGas extends Model
{
    protected $fillable = ['name', 'social_name','tenant_id', 'desconto', 'cnpj', 'area_atuacao'
    , 'produto', 'tipo_empresa', 'municipio', 'data_inicio', 'data_final',];
}
