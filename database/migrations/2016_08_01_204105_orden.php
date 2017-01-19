<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Orden extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nroOrden');
            $table->date('FIngreso');
            $table->date('FSalida');
            $table->string('observaciones');
           // $table->string('descFalla');
            $table->string('descFalla');
            $table->string('solucion');
            $table->double('valor');
            $table->string('accesorios');
            $table->string('estado');
            $table->integer('persona_id')->unsigned();
            $table->foreign('persona_id')->references('id')->on('persona');
            $table->integer('modelo_id')->unsigned();
            $table->foreign('modelo_id')->references('id')->on('modelo');
            $table->integer('servicio_id')->unsigned();
            $table->foreign('servicio_id')->references('id')->on('servicio');
            $table->string('codTecnico');
            $table->integer('equipo_id')->unsigned();
            $table->foreign('equipo_id')->references('id')->on('equipo');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orden');
    }
}
