<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedirConcessaoProedisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedir_concessao_proedis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tenant_id');
            $table->boolean('editar')->default(false);
            $table->boolean('pedir_editar')->default(false);            
            $table->string('social_name');
            $table->string('nome_empresa');
            $table->string('requerimento');
            $table->string('projeto');
            $table->string('nome_projetista');
            $table->string('cpf_projetista');
            $table->string('telefone_projetista');
            $table->string('endereco_projetista');
            $table->string('municipio_projetista');
            $table->string('uf_projetista');
            $table->string('documento_projetista');
            $table->bigInteger('cnpj');
            $table->string('inscricao_estadual');
            $table->string('certidao_federal');
            $table->string('certidao_estadual');
            $table->string('certidao_municipal');
            $table->string('certidao_trabalhista');
            $table->string('certidao_fgts');
            $table->string('ata_constituicao');
            $table->string('procuracao_responsavel');
            $table->string('rg_responsavel');
            $table->string('comprovante_residencia');
            $table->string('relatorio_gfip');
            $table->string('relatorio_faturamento');
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
        Schema::dropIfExists('pedir_concessao_proedis');
    }
}
