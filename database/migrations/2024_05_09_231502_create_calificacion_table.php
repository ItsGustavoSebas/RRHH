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
        Schema::create('calificacion', function (Blueprint $table) {
            $table->id();
            $table->integer('ptIdioma');  
            $table->integer('ptEducacion');  
            $table->integer('ptReconocimiento');  
            $table->integer('ptExperiencia');  
            $table->integer('ptReferencia');  
      
            $table->unsignedBigInteger('ID_Postulante');


            $table->foreign('ID_Postulante')->references('ID_Usuario')->on('postulantes')->onDelete('cascade');
               


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
        Schema::dropIfExists('calificacion');
    }
};
