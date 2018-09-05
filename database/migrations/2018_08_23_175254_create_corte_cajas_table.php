<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorteCajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corte_cajas', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('tipo');//A arqueo, C corte, I inicio
            $table->decimal('saldoSistema',8,2);
            $table->decimal('saldoCapturado',8,2);
            $table->dateTime('fechaHora')->default(date("Y-m-d H:i:s"));
            
            $table->integer('idUsuario');
            $table->integer('idCaja');
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
        Schema::dropIfExists('corte_cajas');
    }
}
