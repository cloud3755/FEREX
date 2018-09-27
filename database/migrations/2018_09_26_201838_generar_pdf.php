<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GenerarPdf extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('generar_pdfs', function (Blueprint $table) {
            $table->string('folio');
            $table->string('cliente');
            $table->integer('cantidad');
            $table->string('descripcion');
            $table->integer('precio');
            $table->integer('subTotal');
            $table->integer('total');
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
