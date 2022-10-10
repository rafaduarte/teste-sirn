<?php

namespace App\Models\proedi;

use App\Models\Tenant;
use App\proedi\Proedi;
use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;

class PedirConcessaoProedi extends Model
{
    use TenantTrait;

    protected $fillable = [ 'tenant_id','social_name','nome_empresa','requerimento', 'projeto','nome_projetista',
    'cpf_projetista','telefone_projetista','endereco_projetista','municipio_projetista','uf_projetista', 'documento_projetista', 'cnpj', 'inscricao_estadual', 
    'certidao_federal', 'certidao_estadual', 'certidao_municipal', 'certidao_trabalhista',
    'certidao_fgts', 'ata_constituicao', 'procuracao_responsavel', 'rg_responsavel',
    'comprovante_residencia', 'relatorio_gfip', 'relatorio_faturamento', 'documentos',
];

public function formatCnpj($cnpj) {

    $cnpj = substr($cnpj, 0, 2) . '.' . substr($cnpj, 2, 3) . '.' . substr($cnpj, 5, 3) . '/' . substr($cnpj, 8, 4) . '-' . substr($cnpj, 12, 2);

    return $cnpj;
 }

   /* public function tenant()
    {
        $this->belongsTo(Tenant::class);
    } */
}
