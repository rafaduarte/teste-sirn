<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConcessaoRnGasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concessao_rn_gases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tenant_id');
            $table->boolean('editar')->default(false);
            $table->boolean('pedir_editar')->default(false);            
            $table->string('social_name');
            $table->string('nome_empresa');
            $table->bigInteger('cnpj');
            $table->string('requerimento');
            $table->string('instrumento_constitutivo');
            $table->string('estudo_viabilidade');
            $table->string('justificativa_tecnico_economica');
            $table->string('procuracao');
            $table->string('contrato_social_aditivos');
            $table->string('cartao_cnpj');
            $table->string('inscricao_estadual');
            $table->string('certidao_federal');
            $table->string('certidao_estadual');
            $table->string('certidao_municipal');
            $table->string('certidao_trabalhista');
            $table->string('certidao_fgts');
            $table->string('ata_constituicao');
            $table->string('produtos_processos');
            $table->string('comprovante_produtos_processos');
            $table->decimal('projecao_receitas', 18,2);
            $table->string('comprovante_projecao_receitas');
            $table->decimal('projecao_custos', 18,2);
            $table->string('comprovante_projecao_custos');
            $table->decimal('investimento', 18,2);
            $table->string('Comprovante_investimento');
            $table->decimal('projecao_fluxo_caixa', 18,2);
            $table->string('comprovante_fluxo_caixa');
            $table->bigInteger('consumo_gas_mes');
            $table->string('comprovante_consumo');
            $table->bigInteger('demanda_gas_tres_anos');
            $table->string('comprovante_demanda');
            $table->double('percentual_gas');
            $table->string('comprovante_percentual_gas');
            $table->string('quantidade_empregos');
            $table->string('comprovante_quantidade_empregos');
            $table->string('nome_tecnico');
            $table->string('cpf_tecnico');
            $table->string('telefone_tecnico');
            $table->string('endereco_tecnico');
            $table->string('municipio_tecnico');
            $table->string('uf_tecnico');
            $table->string('documento_tecnico');
            $table->string('documentos')->nullable();
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
        Schema::dropIfExists('concessao_rn_gases');
    }
}
