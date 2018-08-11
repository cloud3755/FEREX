<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
        $table->increments('id');
        $table->string('folio');
        $table->string('vendedor');
        $table->string('cliente');
        $table->string('producto');
        $table->decimal('cantidad', 7 , 3 );
        $table->string('precioProducto');
        $table->string('subTotal');
        $table->string('total');
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
        //
    }
}
