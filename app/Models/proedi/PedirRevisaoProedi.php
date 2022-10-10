<?php

namespace App\Models\proedi;

use Illuminate\Database\Eloquent\Model;
use App\Tenant\Traits\TenantTrait;


class PedirRevisaoProedi extends Model
{
    use TenantTrait;

    protected $fillable = ['social_name','name','requerimento', 'cnpj', 'certidao_estadual', 'certidao_trabalhista', 'certidao_fgts',
     'carta_motivos', 'motivos', 'mudanca_local', 'faturamento', 'empregados', 'materia_prima', 'investimento_ped',
      'investimento_conservacao', 'investimento_mao_obra',
];

public function formatCnpj($cnpj) {

    $cnpj = substr($cnpj, 0, 2) . '.' . substr($cnpj, 2, 3) . '.' . substr($cnpj, 5, 3) . '/' . substr($cnpj, 8, 4) . '-' . substr($cnpj, 12, 2);

    return $cnpj;
 }
 
}
