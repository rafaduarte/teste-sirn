<?php

namespace App\Models\RnGas;

use Illuminate\Database\Eloquent\Model;

class RequerimentoRnGas extends Model
{
    protected $fillable = ['tenant_id','social_name', 'inscricao_estadual', 'cnpj', 'endereco_empresa', 'municipio', 
    'cep', 'telefone', 'email'];
}
