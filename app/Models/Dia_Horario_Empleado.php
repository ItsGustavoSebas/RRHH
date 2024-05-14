<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dia_Horario_Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'ID_DiaTrabajo',
        'ID_Horario_Empleado'
    ];

    public function DiaTrabajo()
    {
        return $this->belongsTo(DiaTrabajo::class, 'ID_DiaTrabajo');
    }
    public function HorarioEmpleado()
    {
     return $this->belongsTo(Horario_Empleado::class, 'ID_Horario_Empleado');
    }
    public function Asistencias()
    {
        return $this->belongsToMany(Asistencia::class, 'dia__asistencias', 'ID_Dia_Horario_Empleado', 'ID_Asistencia');
    }

}
