<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrevista extends Model
{
    use HasFactory;
    protected $table = 'entrevistas';

    protected $primaryKey = 'id';

    protected $fillable = [
        'fecha_inicio',
        'hora',
        'fecha_fin',
        'detalles',
        'ID_Postulante', 
        'ID_Usuario', 


    ];


    public function postulante()
    {
        return $this->belongsTo(Postulante::class, 'ID_Postulante');
    } 

    public function usuario()
    {
        return $this->belongsTo(User::class, 'ID_Usuario');
    }

}
