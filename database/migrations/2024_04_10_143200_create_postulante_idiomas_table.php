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
        Schema::create('postulante_idiomas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ID_Postulante');
            $table->unsignedBigInteger('ID_Idioma');
            $table->foreign('ID_Postulante')->references('ID_Usuario')->on('postulantes')->onDelete('cascade');
            $table->foreign('ID_Idioma')->references('id')->on('idiomas')->onDelete('cascade');
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
        Schema::dropIfExists('postulante_idiomas');
    }
};
