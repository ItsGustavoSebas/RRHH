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
        Schema::create('educaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_institución');
            $table->string('grado_diploma'); 
            $table->string('campo_de_estudio');           
            $table->date('fecha_de_finalizacion'); 
            $table->string('notas_adicionales');    
            $table->unsignedBigInteger('ID_Postulante')->nullable();
            $table->foreign('ID_Postulante')->references('ID_Usuario')->on('postulantes')->onDelete('set null');
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
        Schema::dropIfExists('educaciones');
    }
};
