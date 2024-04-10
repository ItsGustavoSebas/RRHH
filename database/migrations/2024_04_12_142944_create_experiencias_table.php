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
        Schema::create('experiencias', function (Blueprint $table) {
            $table->id();
            $table->string('cargo');
            $table->string('descripcion'); 
            $table->integer('años');           
            $table->string('lugar');    
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
        Schema::dropIfExists('experiencias');
    }
};
