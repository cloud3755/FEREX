<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas_detalles', function (Blueprint $table) {
            $table->increments('id');
           
            $table->string('Producto');
            $table->decimal('cantidad',10,2);
            $table->decimal('precio',10,2);

            $table->integer('idVenta');//id que apunta a ventas
            $table->integer('idProducto');

            $table->timestamps();

            //subtotal y total se pueden calcular, por lo que no es necesario guardarlos
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas_detalles');
    }
}
