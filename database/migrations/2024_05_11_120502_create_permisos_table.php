<?php

// database/migrations/{timestamp}_create_permisos_personal_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // ID del usuario que solicita el permiso
            $table->string('motivo');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->boolean('aprobado')->default(false); // Indica si el permiso ha sido aprobado
            $table->boolean('denegado')->default(false); // Indica si el permiso ha sido denegado
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
        Schema::dropIfExists('permisos');
    }
}
