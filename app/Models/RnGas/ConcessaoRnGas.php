<?php

namespace App\Models\RnGas;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;

class ConcessaoRnGas extends Model
{
   use TenantTrait;

   protected $fillable = ['social_name', 'nome_empresa', 'cnpj', 'requerimento',
    'instrumento_constitutivo', 'estudo_viabilidade', 'justificativa_tecnico_economica', 'procuracao',
     'contrato_social_aditivos', 'procuracao', 'cartao_cnpj', 'inscricao_estadual', 'certidao_federal',
     'certidao_estadual', 'certidao_municipal', 'certidao_trabalhista', 'certidao_fgts', 'ata_constituicao',
     'produtos_processos', 'comprovante_produtos_processos', 'projecao_receitas', 'comprovante_projecao_receitas',
     'projecao_custos', 'comprovante_projecao_custos', 'investimento', 'Comprovante_investimento', 'projecao_fluxo_caixa',
     'comprovante_fluxo_caixa', 'consumo_gas_mes', 'comprovante_consumo', 'demanda_gas_tres_anos', 'comprovante_demanda',
     'percentual_gas', 'comprovante_percentual_gas', 'quantidade_empregos', 'comprovante_quantidade_empregos', 
     'nome_tecnico', 'cpf_tecnico', 'telefone_tecnico', 'endereco_tecnico', 'municipio_tecnico', 'uf_tecnico', 
     'documento_tecnico', 'documentos',];

      public function formatCnpj($cnpj) {

                $cnpj = substr($cnpj, 0, 2) . '.' . substr($cnpj, 2, 3) . '.' . substr($cnpj, 5, 3) . '/' . substr($cnpj, 8, 4) . '-' . substr($cnpj, 12, 2);
            
                return $cnpj;
             }
}
