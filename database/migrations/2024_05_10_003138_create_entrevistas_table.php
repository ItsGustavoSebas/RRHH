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
        Schema::create('entrevistas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_inicio');  
            $table->string('hora');  
            $table->date('fecha_fin');  
            $table->string('detalles');  
      
      
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
        Schema::dropIfExists('entrevistas');
    }
};
