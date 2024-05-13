<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaTrabajo extends Model
{
    use HasFactory;
    protected $table = 'dia_trabajos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'Nombre',
    ];

    public function Horario_Empleados()
    {
        return $this->belongsToMany(Horario_Empleado::class, 'dia__horario__empleados', 'ID_DiaTrabajo', 'ID_Horario_Empleado');
    }
}
