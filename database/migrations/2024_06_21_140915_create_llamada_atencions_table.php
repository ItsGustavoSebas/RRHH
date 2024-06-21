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
        Schema::create('llamada_atencions', function (Blueprint $table) {
            $table->id();
            $table->string('motivo');
            $table->date('fecha');
            $table->string('gravedad');
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
        Schema::dropIfExists('llamada_atencions');
    }
};
