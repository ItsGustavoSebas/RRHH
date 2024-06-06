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
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->date('FechaMarcada');
            $table->time('HoraMarcada');
            $table->boolean('Puntual')->default(false);
            $table->boolean('Atraso')->default(false);
            $table->boolean('FaltaInjustificada')->default(false);
            $table->boolean('FaltaJustificada')->default(false);
            $table->integer('ID_Empleado')->foreign('ID_Empleado')->references('ID_Usuario')->on('empleados')->onDelete('cascade');
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
        Schema::dropIfExists('asistencias');
    }
};
