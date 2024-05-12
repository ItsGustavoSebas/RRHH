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
        Schema::create('empleados', function (Blueprint $table) {
            $table->unsignedBigInteger('ID_Usuario');
            $table->string('ruta_imagen_e', 2048)->nullable();
            $table->string('genero')->nullable();
            $table->string('estadocivil')->nullable();
            $table->date('fechanac')->nullable();
            $table->foreign('ID_Usuario')->references('id')->on('users')->onDelete('cascade');
            $table->integer('ID_Departamento')->foreign('ID_Departamento')->references('id')->on('departamentos')->onDelete('set null')->nullable();
            $table->integer('ID_Cargo')->foreign('ID_Cargo')->references('id')->on('cargos')->onDelete('set null')->nullable();
            $table->integer('ID_Horario')->foreign('ID_Horario')->references('id')->on('horarios')->onDelete('set null')->nullable();
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
        Schema::dropIfExists('empleados');
    }
};
