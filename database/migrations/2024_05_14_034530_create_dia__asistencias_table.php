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
        Schema::create('dia__asistencias', function (Blueprint $table) {
            $table->id();
            $table->integer('ID_Asistencia')->foreign('ID_Asistencia')->references('id')->on('asistencias')->onDelete('cascade');
            $table->integer('ID_Dia_Horario_Empleado')->foreign('ID_Dia_Horario_Empleado')->references('id')->on('dia__horario__empleados')->onDelete('cascade');
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
        Schema::dropIfExists('dia__asistencias');
    }
};
