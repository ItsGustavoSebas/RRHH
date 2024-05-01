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
        Schema::create('bitacoras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ID_Usuario');
            $table->text('entrada')->nullable();
            $table->text('salida')->nullable();
            $table->text('usuario')->nullable();
            $table->text('tipo')->nullable();
            $table->text('direccionIp')->nullable();
            $table->text('navegador')->nullable();
            $table->foreign('ID_Usuario')->references('id')->on('users');
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
        Schema::dropIfExists('bitacoras');
    }
};
