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

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'ID_Horario');
    }
}
