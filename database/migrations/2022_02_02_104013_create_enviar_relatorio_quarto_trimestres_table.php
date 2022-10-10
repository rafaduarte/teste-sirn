<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnviarRelatorioQuartoTrimestresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enviar_relatorio_quarto_trimestres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tenant_id');
            $table->boolean('editar')->default(false);
            $table->boolean('pedir_editar')->default(false);
            $table->string('razao_social');
            $table->string('nome_fantasia');
            $table->bigInteger('cnpj');
            $table->string('endereco_empresa');
            $table->string('email');
            $table->string('telefone');
            $table->string('outros_beneficios');
            $table->string('placa_proedi');
            $table->string('placa_proedi_upload')->nullable();
            $table->decimal('faturamento_outubro',18,2);
            $table->decimal('faturamento_novembro',18,2);
            $table->decimal('faturamento_dezembro',18,2);
            $table->string('faturamento_upload');
            $table->string('empregos_gerados_trimestre_outubro');
            $table->string('empregos_gerados_trimestre_novembro');
            $table->string('empregos_gerados_trimestre_dezembro');
            $table->string('empregos_gerados_trimestre_upload');
            $table->string('empregos_gerados_proedi');
            $table->string('empregos_gerados_proedi_upload');
            $table->string('materia_prima_adquirida_rn');
            $table->string('materia_prima_adquirida_rn_upload');
            $table->decimal('icms_total_devido_outubro',18,2);
            $table->decimal('icms_total_devido_novembro',18,2);
            $table->decimal('icms_total_devido_dezembro',18,2);
            $table->string('icms_total_devido_upload');
            $table->decimal('icms_total_pago_outubro',18,2);
            $table->decimal('icms_total_pago_novembro',18,2);
            $table->decimal('icms_total_pago_dezembro',18,2);
            $table->string('icms_total_pago_upload');
            $table->decimal('investimento_projetado',18,2);
            $table->string('investimento_projetado_upload');
            $table->decimal('investimento_realizado_outubro',18,2);
            $table->decimal('investimento_realizado_novembro',18,2);
            $table->decimal('investimento_realizado_dezembro',18,2);
            $table->string('investimento_realizado_upload');
            $table->decimal('investimento_total_realizado',18,2);
            $table->string('investimento_total_realizado_upload');
            $table->string('n_empregos_diretos_atuais');
            $table->string('n_empregos_diretos_atuais_upload');
            $table->string('possui_menores_aprendizes');
            $table->string('possui_menores_aprendizes_upload')->nullable();
            $table->string('possui_estagiarios');
            $table->string('possui_estagiarios_upload')->nullable();
            $table->string('possui_trainee');
            $table->string('possui_trainee_upload')->nullable();
            $table->string('destino_mercadoria');
            $table->string('destino_mercadoria_upload');
            $table->timestamps();

            $table->foreign('tenant_id')
                        ->references('id')
                        ->on('tenants')
                        ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enviar_relatorio_quarto_trimestres');
    }
}
