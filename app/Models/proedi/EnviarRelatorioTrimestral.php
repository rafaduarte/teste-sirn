<?php

namespace App\Models\proedi;

use Illuminate\Database\Eloquent\Model;
use App\Tenant\Traits\TenantTrait;

class EnviarRelatorioTrimestral extends Model
{
    use TenantTrait;

    protected $fillable = ['razao_social','nome_fantasia','cnpj','endereco_empresa', 'email', 'telefone', 'outros_beneficios', 'placa_proedi', 'placa_proedi_upload',
    'faturamento_janeiro','faturamento_fevereiro','faturamento_marco','faturamento_upload', 'empregos_gerados_trimestre_janeiro',
     'empregos_gerados_trimestre_fevereiro', 'empregos_gerados_trimestre_marco', 'empregos_gerados_trimestre_upload', 'empregos_gerados_proedi',
     'empregos_gerados_proedi_upload', 'materia_prima_adquirida_rn', 'materia_prima_adquirida_rn_upload', 'icms_total_devido_janeiro', 'icms_total_devido_fevereiro',
     'icms_total_devido_marco', 'icms_total_devido_upload', 'icms_total_pago_janeiro', 'icms_total_pago_fevereiro', 'icms_total_pago_marco', 'icms_total_pago_upload',
     'investimento_projetado', 'investimento_projetado_upload', 'investimento_realizado_janeiro', 'investimento_realizado_fevereiro', 'investimento_realizado_marco',
     'investimento_realizado_upload', 'investimento_total_realizado', 'investimento_total_realizado_upload', 'n_empregos_diretos_atuais', 'n_empregos_diretos_atuais_upload',
     'possui_menores_aprendizes', 'possui_menores_aprendizes_upload', 'possui_estagiarios', 'possui_estagiarios_upload', 'possui_trainee', 'possui_trainee_upload', 'destino_mercadoria',
     'destino_mercadoria_upload'];
}
