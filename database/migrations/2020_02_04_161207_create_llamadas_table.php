<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLlamadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('llamadas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('aunto');
            $table->dateTime('fecha_hora');
            $table->string('estatus')->comment('pendiente, realizada, no realizada');
            $table->unsignedBigInteger('prospectos_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('prospectos_id')->references('id')->on('prospectos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('llamadas');
    }
}
