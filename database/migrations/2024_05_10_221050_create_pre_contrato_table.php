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
        Schema::create('pre_contrato', function (Blueprint $table) {
            $table->id();
            $table->string('genero')->nullable();
            $table->string('estadocivil')->nullable();
            $table->integer('rol')->nullable();
            
            $table->unsignedBigInteger('ID_Postulante')->nullable();
            $table->foreign('ID_Postulante')->references('ID_Usuario')->on('postulantes')->onDelete('cascade');

            $table->unsignedBigInteger('ID_Usuario')->nullable();
            $table->foreign('ID_Usuario')->references('id')->on('users');


            $table->integer('ID_Departamento')->foreign('ID_Departamento')->references('id')->on('departamentos')->onDelete('set null')->nullable();
            $table->integer('ID_Cargo')->foreign('ID_Cargo')->references('id')->on('cargos')->onDelete('set null')->nullable();
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
        Schema::dropIfExists('pre_contrato');
    }
};
