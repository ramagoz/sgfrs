<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('importaciones', function (Blueprint $table) {
            $table->increments('id_importacion');
            $table->integer('id_periodo')->references('id_periodo')->on('periodos');
            $table->smallInteger('total_rec');
            $table->smallInteger('emp_sin_rec');
            $table->smallInteger('rec_sin_emp');
            $table->smallInteger('rec_con_err');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('importaciones');
    }
}
