<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->string('cedula',7)->primary();
            $table->integer('id_usuario')->references('id')->on('users')->unique();
            $table->integer('id_grupo')->references('id_grupo')->on('grupos_recibos');
            $table->integer('id_rol')->foreign('id_rol')->references('id_rol')->on('roles');
            $table->string('nombres',50);
            $table->string('apellidos',50);
            $table->string('tel',20)->nullable();
            $table->string('cel',20);
            $table->string('dpto',100)->nullable();
            $table->string('cargo',100)->nullable();
            $table->string('correo',100)->unique();
            $table->boolean('estado');
            $table->string('obs',500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
