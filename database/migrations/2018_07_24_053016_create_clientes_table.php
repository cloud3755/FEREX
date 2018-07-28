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
            $table->string('nombre');
            $table->string('razonSocial');
            $table->string('contacto');
            $table->string('rfc');
            $table->string('email' , 30);
            $table->decimal('limiteCredito',7,2);//el limite para enviar notificaciones;
            $table->decimal('credito',7,2);//credito actual;
            
            $table->string('telefono1' , 30);
            $table->string('telefono2' , 30);
            $table->string('telefono3' , 30);

            $table->decimal('consumoTotal' , 10,2);// Total hisotorico de venta


            $table->boolean('activo')->default(true);
            $table->integer('idDireccion');
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
