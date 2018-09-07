<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDireccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direcciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numInterior')->nullable();
            $table->string('numExterior');
            $table->string('calle');
            $table->string('entre1');
            $table->string('entre2');
            $table->string('referencia');
            $table->string('colonia');
            $table->string('CP');
            $table->string('ciudad');
            $table->string('estado');
            $table->string('pais')->default("México");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('direcciones');
    }
}
