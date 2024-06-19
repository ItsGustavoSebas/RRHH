<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion_Empleado extends Model
{
    use HasFactory;

    protected $table = 'calificacion_empleado';

    protected $primaryKey = 'id';

    protected $fillable = [
        'cantAsisTotalesEsperadas',
        'cantAsisPuntuales', 
        'cantAsisAtraso', 
        'cantFaltInjustificada', 
        'cantFaltaJustificada', 
        'mes', 
        'anio', 
        'puntaje',
        'ID_Empleado', 

    ];


    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'ID_Empleado');
    } 
}
