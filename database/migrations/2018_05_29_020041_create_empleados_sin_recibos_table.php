<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosSinRecibosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados_sin_recibos', function (Blueprint $table) {
            $table->increments('id_emp_sin_rec');
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
        Schema::dropIfExists('empleados_sin_recibos');
    }
}
