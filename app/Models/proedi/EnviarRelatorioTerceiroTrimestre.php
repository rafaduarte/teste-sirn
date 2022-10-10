<?php

namespace App\Models\proedi;

use Illuminate\Database\Eloquent\Model;
use App\Tenant\Traits\TenantTrait;

class EnviarRelatorioTerceiroTrimestre extends Model
{
    use TenantTrait;

    protected $fillable = ['razao_social','nome_fantasia','cnpj','endereco_empresa', 'email', 'telefone', 'outros_beneficios', 'placa_proedi', 'placa_proedi_upload',
    'faturamento_julho','faturamento_agosto','faturamento_setembro','faturamento_upload', 'empregos_gerados_trimestre_julho',
    'empregos_gerados_trimestre_agosto', 'empregos_gerados_trimestre_setembro', 'empregos_gerados_trimestre_upload', 'empregos_gerados_proedi',
    'empregos_gerados_proedi_upload', 'materia_prima_adquirida_rn', 'materia_prima_adquirida_rn_upload', 'icms_total_devido_julho', 'icms_total_devido_agosto',
    'icms_total_devido_setembro', 'icms_total_devido_upload', 'icms_total_pago_julho', 'icms_total_pago_agosto', 'icms_total_pago_setembro', 'icms_total_pago_upload',
    'investimento_projetado', 'investimento_projetado_upload', 'investimento_realizado_julho', 'investimento_realizado_agosto', 'investimento_realizado_setembro',
    'investimento_realizado_upload', 'investimento_total_realizado', 'investimento_total_realizado_upload', 'n_empregos_diretos_atuais', 'n_empregos_diretos_atuais_upload',
    'possui_menores_aprendizes', 'possui_menores_aprendizes_upload', 'possui_estagiarios', 'possui_estagiarios_upload', 'possui_trainee', 'possui_trainee_upload', 'destino_mercadoria',
    'destino_mercadoria_upload'];
}
