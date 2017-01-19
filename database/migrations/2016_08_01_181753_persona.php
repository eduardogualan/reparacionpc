<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Persona extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('persona', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cedula');
            $table->string('apellidos');
            $table->string('nombres');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('email');
            $table->string('ciudad');
            $table->string('horario');
            $table->integer('nroEquipos');
            $table->integer('rol_id')->unsigned();
            $table->foreign('rol_id')->references('id')->on('rol');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('persona');
    }

}
