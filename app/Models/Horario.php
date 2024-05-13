<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    protected $table = 'horarios';

    protected $primaryKey = 'id';

    protected $fillable = [
        'HoraInicio',
        'HoraFin',
        'HoraLimite',
    ];

    public function Empleados()
    {
        return $this->belongsToMany(Empleado::class, 'horario__empleados', 'ID_Empleado', 'ID_Horario');
    }

}
