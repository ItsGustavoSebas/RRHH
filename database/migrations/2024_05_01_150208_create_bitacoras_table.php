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
            $table->datetime('entrada')->nullable();
            $table->datetime('salida')->nullable();
            $table->string('usuario')->nullable();
            $table->string('tipo')->nullable();
            $table->string('direccionIp')->nullable();
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
