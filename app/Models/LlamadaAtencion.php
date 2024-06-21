<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LlamadaAtencion extends Model
{
    use HasFactory;

    protected $table = 'llamada_atencions';

    protected $primaryKey = 'id';

    protected $fillable = [
        'motivo',
        'fecha',
        'gravedad',
        'ID_Empleado',
    ];

    public function empleado()
    {
     return $this->belongsTo(Empleado::class, 'ID_Empleado');
    }
}
