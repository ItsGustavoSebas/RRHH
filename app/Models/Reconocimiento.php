<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reconocimiento extends Model
{
    use HasFactory;
    protected $table = 'reconocimientos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre', 
        'descripcion', 
        'ID_Postulante', 

    ];


    public function postulante()
    {
        return $this->belongsTo(Postulante::class, 'ID_Usuario');
    }

}
