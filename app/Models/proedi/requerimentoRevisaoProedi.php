<?php

namespace App\Models\proedi;

use Illuminate\Database\Eloquent\Model;

class requerimentoRevisaoProedi extends Model
{
    protected $fillable = ['tenant_id','social_name', 'inscricao_estadual', 'cnpj', 'endereco_empresa', 'municipio', 
    'cep', 'telefone', 'email'];
}
