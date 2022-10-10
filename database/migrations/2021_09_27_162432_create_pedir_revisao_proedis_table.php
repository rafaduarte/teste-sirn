<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedirRevisaoProedisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedir_revisao_proedis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tenant_id');
            $table->boolean('editar')->default(false);
            $table->boolean('pedir_editar')->default(false);
            $table->string('social_name');
            $table->string('name');
            $table->string('requerimento');
            $table->bigInteger('cnpj');
            $table->string('certidao_estadual');
            $table->string('certidao_trabalhista');
            $table->string('certidao_fgts');
            $table->string('carta_motivos');
            $table->string('motivos');
            $table->string('mudanca_local')->nullable();
            $table->string('faturamento')->nullable();
            $table->string('empregados')->nullable();
            $table->string('materia_prima')->nullable();
            $table->string('investimento_ped')->nullable();
            $table->string('investimento_conservacao')->nullable();
            $table->string('investimento_mao_obra')->nullable();
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
        Schema::dropIfExists('pedir_revisao_proedis');
    }
}
