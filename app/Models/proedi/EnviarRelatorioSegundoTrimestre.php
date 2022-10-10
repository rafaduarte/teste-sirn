<?php

namespace App\Models\proedi;

use Illuminate\Database\Eloquent\Model;
use App\Tenant\Traits\TenantTrait;

class EnviarRelatorioSegundoTrimestre extends Model
{
    use TenantTrait;

    protected $fillable = ['razao_social','nome_fantasia','cnpj','endereco_empresa', 'email', 'telefone', 'outros_beneficios', 'placa_proedi',
    'faturamento_abril','faturamento_maio','faturamento_junho','faturamento_upload', 'placa_proedi_upload', 'empregos_gerados_trimestre_abril',
    'empregos_gerados_trimestre_maio', 'empregos_gerados_trimestre_junho', 'empregos_gerados_trimestre_upload', 'empregos_gerados_proedi',
    'empregos_gerados_proedi_upload', 'materia_prima_adquirida_rn', 'materia_prima_adquirida_rn_upload', 'icms_total_devido_abril', 'icms_total_devido_maio',
    'icms_total_devido_junho', 'icms_total_devido_upload', 'icms_total_pago_abril', 'icms_total_pago_maio', 'icms_total_pago_junho', 'icms_total_pago_upload',
    'investimento_projetado', 'investimento_projetado_upload', 'investimento_realizado_abril', 'investimento_realizado_maio', 'investimento_realizado_junho',
    'investimento_realizado_upload', 'investimento_total_realizado', 'investimento_total_realizado_upload', 'n_empregos_diretos_atuais', 'n_empregos_diretos_atuais_upload',
    'possui_menores_aprendizes', 'possui_menores_aprendizes_upload', 'possui_estagiarios', 'possui_estagiarios_upload', 'possui_trainee', 'possui_trainee_upload', 'destino_mercadoria',
    'destino_mercadoria_upload'];
}
