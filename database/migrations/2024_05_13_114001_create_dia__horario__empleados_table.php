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
        Schema::create('dia__horario__empleados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ID_DiaTrabajo');
            $table->unsignedBigInteger('ID_Horario_Empleado');
            $table->foreign('ID_DiaTrabajo')->references('id')->on('dia_trabajos')->onDelete('cascade');
            $table->foreign('ID_Horario_Empleado')->references('id')->on('horario__empleados')->onDelete('cascade');
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
        Schema::dropIfExists('dia__horario__empleados');
    }
};
