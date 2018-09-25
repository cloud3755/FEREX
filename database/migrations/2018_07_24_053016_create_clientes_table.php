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
            $table->string('email' , 200);
            $table->string('telefono1' , 200);//<telefonos separados por comas
            $table->decimal('limiteCredito',9,2);//el limite para enviar notificaciones;
            $table->decimal('credito',9,2);//credito actual;
            $table->decimal('consumoTotal' , 10,2);// Total hisotorico de venta
            $table->boolean('aceptarCredito')->default(true);
            $table->integer('diasCredito')->default(0);
            $table->string('noRegIdTributaria', 30)->nullable();
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
