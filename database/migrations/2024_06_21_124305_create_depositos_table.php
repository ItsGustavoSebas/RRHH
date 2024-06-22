<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositosTable extends Migration
{
    public function up()
    {
        Schema::create('depositos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empleado_id');
            $table->boolean('depositado')->default(false);
            $table->date('fecha');
            $table->decimal('monto', 8, 2);
            $table->timestamps();

            $table->foreign('empleado_id')->references('ID_Usuario')->on('empleados')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('depositos');
    }
}
