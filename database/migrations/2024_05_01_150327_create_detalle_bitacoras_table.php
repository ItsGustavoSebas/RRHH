<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_bitacoras', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('ID_Bitacora');
            $table->text('accion')->nullable();
            $table->text('metodo')->nullable();
            $table->text('hora')->nullable();
            $table->text('tabla')->nullable();
            $table->text('registroId')->nullable();
            $table->text('ruta')->nullable();
            $table->foreign('ID_Bitacora')->references('id')->on('bitacoras')->onDelete('cascade');
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
        Schema::dropIfExists('detalle_bitacoras');
    }
};
