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
            $table->string('numExterior')->nullable();
            $table->string('calle')->nullable();
            $table->string('entre1')->nullable();
            $table->string('entre2')->nullable();
            $table->string('referencia')->nullable();
            $table->string('colonia')->nullable();
            $table->string('CP')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('estado')->nullable();
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
