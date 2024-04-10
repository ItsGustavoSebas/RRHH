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
        return $this->belongsTo(postulante::class, 'ID_Usuario', 'ID_Usuario');
    } 

    public function idioma() {
        return $this->belongsTo(idioma::class, 'ID_Idioma', 'id');
    }
}
