<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Modelo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modelo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_modelo');
            $table->integer('marca_id')->unsigned();
            // Indicamos cual es la clave foránea de esta tabla:
            $table->foreign('marca_id')->references('id')->on('marca');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('modelo');
    }
}
