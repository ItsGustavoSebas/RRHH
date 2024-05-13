<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulante_Idioma extends Model
{
    use HasFactory;
    protected $table = 'experiencias';

    protected $primaryKey = 'id';

    protected $fillable = [
        'ID_Postulante', 
        'ID_Idioma', 

    ];


    public function postulante()
    {
        return $this->belongsTo(Postulante::class, 'ID_Postulante');
    } 

    public function idioma() {
        return $this->belongsTo(Idioma::class, 'ID_Idioma', 'id');
    }
}
