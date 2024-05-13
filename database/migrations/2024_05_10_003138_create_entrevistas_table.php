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
            $table->integer('puntos')->nullable();
            
      
      
            $table->unsignedBigInteger('ID_Postulante')->nullable();
            $table->unsignedBigInteger('ID_Usuario')->nullable();
            $table->foreign('ID_Postulante')->references('ID_Usuario')->on('postulantes')->onDelete('cascade');
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
        Schema::dropIfExists('entrevistas');
    }
};
