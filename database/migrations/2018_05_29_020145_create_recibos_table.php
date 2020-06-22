<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecibosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recibos', function (Blueprint $table)
        {
            $table->string('id_recibo',13)->primary();
            $table->integer('id_estado_recibo')->references('id_estado_recibo')->on('estado_recibos');
            $table->string('cedula',7)->references('cedula')->on('personas');
            $table->integer('id_periodo')->references('id_periodo')->on('periodos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recibos');
    }
}
