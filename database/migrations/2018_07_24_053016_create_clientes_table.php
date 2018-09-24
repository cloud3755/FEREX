<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rfc');
            $table->string('nombre');
            $table->string('razonSocial');
            $table->string('email' , 70);
            $table->string('Calle' , 50);
            $table->integer('numExterior');
            $table->integer('numInterior');
            $table->integer('codigoPostal');
            $table->string('colonia' , 50);
            $table->string('ciudad' , 50);
            $table->string('municipio' , 50);
            $table->string('estado' , 50);
            $table->string('pais' , 50);
            $table->string('telefono1' , 30);
            $table->decimal('limiteCredito',7,2);//el limite para enviar notificaciones;
            $table->decimal('credito',7,2);//credito actual;
            $table->decimal('consumoTotal' , 10,2);// Total hisotorico de venta
            $table->boolean('activo')->default(true);
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
        Schema::dropIfExists('clientes');
    }
}
