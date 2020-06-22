<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditorias', function (Blueprint $table) {
            $table->increments('id_auditoria');
            $table->dateTime('fecha_hora');
            $table->string('cedula',7)->references('cedula')->on('personas');
            $table->integer('rol')->references('id_rol')->on('roles');
            $table->string('ip',16);
            $table->string('operacion',50);
            $table->string('descripcion',500);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auditorias');
    }
}
