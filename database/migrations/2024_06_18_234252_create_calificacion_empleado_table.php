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
        Schema::create('calificacion_empleado', function (Blueprint $table) {
            $table->id();
            $table->integer('cantAsisTotalesEsperadas')->nullable();  
            $table->integer('cantAsisPuntuales')->nullable(); 
            $table->integer('cantAsisAtraso')->nullable(); 
            $table->integer('cantFaltInjustificada')->nullable(); 
            $table->integer('cantFaltaJustificada')->nullable(); 
            $table->string('mes')->nullable(); 
            $table->string('anio')->nullable(); 
            $table->integer('puntaje')->nullable(); 
      
            $table->unsignedBigInteger('ID_Empleado');



            $table->foreign('ID_Empleado')->references('ID_Usuario')->on('empleados')->onDelete('cascade');
               


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
        Schema::dropIfExists('calificacion_empleado');
    }
};
