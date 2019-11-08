<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecibosConErroresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recibos_con_errores', function (Blueprint $table)
        {
            $table->String('id')->primary();
            $table->string('id_recibo');
            $table->String('cedula');
            $table->string('motivo_error');
            $table->dateTime('fecha_hora');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recibos_con_errores');
    }
}
