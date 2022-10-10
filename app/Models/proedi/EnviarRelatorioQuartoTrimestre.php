<?php

namespace App\Models\proedi;

use Illuminate\Database\Eloquent\Model;
use App\Tenant\Traits\TenantTrait;

class EnviarRelatorioQuartoTrimestre extends Model
{
    use TenantTrait;
    
    protected $fillable = ['razao_social','nome_fantasia','cnpj','endereco_empresa', 'email', 'telefone', 'outros_beneficios', 'placa_proedi', 'placa_proedi_upload',
    'faturamento_outubro','faturamento_novembro','faturamento_dezembro','faturamento_upload', 'empregos_gerados_trimestre_outubro',
    'empregos_gerados_trimestre_novembro', 'empregos_gerados_trimestre_dezembro', 'empregos_gerados_trimestre_upload', 'empregos_gerados_proedi',
    'empregos_gerados_proedi_upload', 'materia_prima_adquirida_rn', 'materia_prima_adquirida_rn_upload', 'icms_total_devido_outubro', 'icms_total_devido_novembro',
    'icms_total_devido_dezembro', 'icms_total_devido_upload', 'icms_total_pago_outubro', 'icms_total_pago_novembro', 'icms_total_pago_dezembro', 'icms_total_pago_upload',
    'investimento_projetado', 'investimento_projetado_upload', 'investimento_realizado_outubro', 'investimento_realizado_novembro', 'investimento_realizado_dezembro',
    'investimento_realizado_upload', 'investimento_total_realizado', 'investimento_total_realizado_upload', 'n_empregos_diretos_atuais', 'n_empregos_diretos_atuais_upload',
    'possui_menores_aprendizes', 'possui_menores_aprendizes_upload', 'possui_estagiarios', 'possui_estagiarios_upload', 'possui_trainee', 'possui_trainee_upload', 'destino_mercadoria',
    'destino_mercadoria_upload'];
}
