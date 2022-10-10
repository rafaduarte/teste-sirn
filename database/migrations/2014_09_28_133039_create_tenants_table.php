<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('social_name');
            $table->string('name');
            $table->bigInteger('cnpj')->unique();
            $table->string('inscricao_estadual');
            $table->string('endereco_empresa');
            $table->string('municipio');
            $table->string('uf');
            $table->bigInteger('cep');
            $table->string('telefone');
            $table->string('email')->unique();
            $table->dateTime('inicio_atividade');
            $table->string('tipo_empresa');
            $table->string('nome_empresario');
            $table->bigInteger('cpf');
            $table->string('endereco_empresario');
            $table->string('municipio_empresario');
            $table->string('uf_empresario');
            $table->bigInteger('cep_empresario');
            $table->string('telefone_empresario');
            $table->string('email_empresario');
            $table->timestamps();

            $table->enum('active', ['Y', 'N'])->default('Y');
            $table->date('subscription')->nullable(); // Date que se inscreveu

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenants');
    }
}
