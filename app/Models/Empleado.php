<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Empleado extends Model
{
    use HasFactory;
    use HasRoles;

    protected $table = 'empleados';

    protected $primaryKey = 'ID_Usuario';

    protected $fillable = [
        'ID_Cargo',
        'ruta_imagen_e',
        'ID_Departamento',
        'fechanac',
        'genero',
        'estadocivil',
        'ID_Sueldo',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'ID_Usuario');
    }

    public function sueldo()
    {
        return $this->belongsTo(Sueldo::class, 'ID_Sueldo');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'ID_Departamento');
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'ID_Cargo');
    }

    public function getEdadAttribute()
    {
        return Carbon::parse($this->fechanac)->age;
    }

    public function Horarios()
    {
        return $this->belongsToMany(Horario::class, 'horario__empleados', 'ID_Empleado', 'ID_Horario');
    }

    public function diasTrabajo()
    {
        // Obtener los IDs de los horarios asignados al empleado
        $horariosIds = $this->Horarios()->pluck('ID_Horario');

        // Obtener los IDs de los horarios_empleados asociados con esos horarios
        $horariosEmpleadosIds = Horario_Empleado::whereIn('ID_Horario', $horariosIds)->pluck('id');

        // Obtener los IDs de los días de trabajo asociados con esos horarios_empleados
        $diasTrabajoIds = Dia_Horario_Empleado::whereIn('ID_Horario_Empleado', $horariosEmpleadosIds)->pluck('ID_DiaTrabajo');

        // Obtener los días de trabajo asociados con esos IDs
        return DiaTrabajo::whereIn('id', $diasTrabajoIds)->get();
    }

    public function horario_empleado()
    {
        return $this->hasMany(Horario_Empleado::class, 'ID_Empleado');
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'ID_Empleado');
    }
}
