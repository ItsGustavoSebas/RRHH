<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experiencia extends Model
{
    use HasFactory;

    protected $table = 'experiencias';

    protected $primaryKey = 'id';

    protected $fillable = [
        'cargo', 
        'descripcion', 
        'años', 
        'lugar', 
        'ID_Postulante', 

    ];


    public function postulante()
    {
        return $this->belongsTo(postulante::class, 'ID_Usuario');
    } 
}
