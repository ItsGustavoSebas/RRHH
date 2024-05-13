<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario_Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'ID_Horario',
        'ID_Empleado'
    ];

    public function Horario()
    {
        return $this->belongsTo(Horario::class, 'ID_Horario');
    }
    public function Empleado()
    {
     return $this->belongsTo(Empleado::class, 'ID_Empleado');
    }
}
