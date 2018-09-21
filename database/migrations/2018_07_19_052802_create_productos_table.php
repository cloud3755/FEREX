<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('descripcion')->nullable()->default("");
            $table->string('claveProdServ')->nullable()->default("");
            $table->integer('minimoAlarma')->nullable();
            $table->string('codigoBarras')->unique()->nullable();
            $table->boolean('activo')->default(true);
            $table->decimal('precioA',10,2)->default(0);
            $table->decimal('precioB',10,2)->default(0);
            $table->decimal('precioC',10,2)->default(0);
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
        Schema::dropIfExists('productos');
    }
}
