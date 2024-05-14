<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dia_Asistencia extends Model
{
    use HasFactory;
    protected $fillable = [
        'ID_Asistencia',
        'ID_Dia_Horario_Empleado'
    ];

    public function Asistencia()
    {
        return $this->belongsTo(Asistencia::class, 'ID_Asistencia');
    }
    public function Dia_Horario_Empleado()
    {
     return $this->belongsTo(Dia_Horario_Empleado::class, 'ID_Dia_Horario_Empleado');
    }
}
