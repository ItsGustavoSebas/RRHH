<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $table = 'asistencias';

    protected $primaryKey = 'id';

    protected $fillable = [
        'FechaMarcada',
        'HoraMarcada',
        'Puntual',
        'Atraso',
        'FaltaInjustificada',
        'FaltaJustificada',
        'ID_Empleado',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'ID_Empleado');
    }

    public function Dia_asistencias()
    {
        return $this->belongsToMany(Dia_Horario_Empleado::class, 'dia__asistencias', 'ID_Dia_Horario_Empleado', 'ID_Asistencia');
    }
}
