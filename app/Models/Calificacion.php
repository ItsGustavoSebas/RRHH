<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    use HasFactory;

    protected $table = 'calificacion';

    protected $primaryKey = 'id';

    protected $fillable = [
        'ptIdioma', 
        'ptEducacion', 
        'ptReconocimiento', 
        'ptExperiencia', 
        'ptReferencia', 
        'ID_Postulante', 

    ];


    public function postulante()
    {
        return $this->belongsTo(Postulante::class, 'ID_Postulante');
    } 
}
