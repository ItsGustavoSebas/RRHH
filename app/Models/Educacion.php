<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Educacion extends Model
{
    use HasFactory;

    protected $table = 'educaciones';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre_colegio', 
        'grado_diploma', 
        'campo_de_estudio', 
        'fecha_de_finalizacion', 
        'notas_adicionales', 
        'ID_Postulante', 

    ];


    public function postulante()
    {
        return $this->belongsTo(postulante::class, 'ID_Usuario');
    } 
}
