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
        Schema::create('horario__empleados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ID_Horario');
            $table->unsignedBigInteger('ID_Empleado');
            $table->foreign('ID_Horario')->references('id')->on('horarios')->onDelete('cascade');
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
        Schema::dropIfExists('horario__empleados');
    }
};
