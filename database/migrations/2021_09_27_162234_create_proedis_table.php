<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProedisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proedis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tenant_id');
            $table->string('name');
            $table->string('desconto');
            $table->string('area_atuacao');
            $table->string('produto');
            $table->string('tipo_empresa');
            $table->string('municipio');
            $table->date('data_inicio');
            $table->date('data_final');
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
        Schema::dropIfExists('proedis');
    }
}
