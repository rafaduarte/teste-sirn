<?php

namespace App\Models\proedi;

use Illuminate\Database\Eloquent\Model;
use App\Tenant\Traits\TenantTrait;


class EnviarRelatorioProedi extends Model
{
    use TenantTrait;

    protected $fillable = ['nome_empresa','documentos', 'cnpj', 'requerimento',];
}
