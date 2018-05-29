<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposRecibosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos_recibos', function (Blueprint $table) {
            $table->increments('id_grupo');
            $table->string('nombre_grupo');
            $table->tinyInteger('ene');
            $table->tinyInteger('feb');
            $table->tinyInteger('mar');
            $table->tinyInteger('abr');
            $table->tinyInteger('may');
            $table->tinyInteger('jun');
            $table->tinyInteger('jul');
            $table->tinyInteger('ago');
            $table->tinyInteger('set');
            $table->tinyInteger('oct');
            $table->tinyInteger('nov');
            $table->tinyInteger('dic');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupos_recibos');
    }
}
